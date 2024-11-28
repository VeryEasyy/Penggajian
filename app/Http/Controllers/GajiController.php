<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\Jabatan;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Mpdf\Mpdf;
use ZipArchive;

class GajiController extends Controller
{
  public function gaji()
  {
     $gaji = Gaji::with('karyawan.jabatan')
                ->orderBy('gaji_bersih', 'desc')
                ->get();

    // Ambil data karyawan dan jabatan (data ini mungkin tidak diperlukan jika hanya untuk keperluan form)
    $karyawans = Karyawan::all();
    $jabatans = Jabatan::all();


    return view('gaji.gaji', compact('karyawans', 'jabatans', 'gaji'));
  }

  public function store(Request $request)
  {
      // Validasi input
      $validatedData = $request->validate([
          'karyawan_id' => 'required|exists:karyawans,id',
          'tanggal_penggajian' => 'required|date',
          'total_tunjangan' => 'required|numeric|min:0',
          'total_potongan' => 'required|numeric|min:0',
      ], [
          'karyawan_id.required' => 'Nama karyawan harus dipilih.',
          'tanggal_penggajian.required' => 'Tanggal penggajian harus diisi.',
          'tanggal_penggajian.date' => 'Tanggal penggajian harus berupa tanggal yang valid.',
          'total_tunjangan.required' => 'Tunjangan harus diisi.',
          'total_tunjangan.numeric' => 'Tunjangan harus berupa angka.',
          'total_potongan.required' => 'Potongan harus diisi.',
          'total_potongan.numeric' => 'Potongan harus berupa angka.',
      ]);
  
      // Ambil karyawan berdasarkan ID yang dipilih
      $karyawan = Karyawan::find($validatedData['karyawan_id']);
  
      if (!$karyawan) {
          return redirect()->route('gaji.gaji')->with('error', 'Karyawan tidak ditemukan.');
      }
  
      // Ambil gaji pokok dari relasi jabatan
      $jabatan = $karyawan->jabatan;
  
      if (!$jabatan) {
          return redirect()->route('gaji.gaji')->with('error', 'Jabatan untuk karyawan ini tidak ditemukan.');
      }
  
      // Hitung gaji bersih
      $gaji_pokok = $jabatan->gaji_pokok; // Gaji pokok dari Jabatan
      $tunjangan = $validatedData['total_tunjangan'];
      $potongan = $validatedData['total_potongan'];
      $gaji_bersih = $gaji_pokok + $tunjangan - $potongan;
  
      // Simpan data gaji baru ke dalam database
      $gaji = Gaji::create([
          'karyawan_id' => $validatedData['karyawan_id'],
          'tanggal_penggajian' => $validatedData['tanggal_penggajian'],
          'total_tunjangan' => $tunjangan,
          'total_potongan' => $potongan,
          'gaji_bersih' => $gaji_bersih,
      ]);
  
      // Cek apakah data berhasil disimpan
      if ($gaji) {
          return redirect()->route('gaji.gaji')->with('success', 'Data gaji berhasil ditambahkan.');
      } else {
          return redirect()->route('gaji.gaji')->with('error', 'Data gaji gagal ditambahkan.');
      }
  }
  


  public function edit(Request $request)
  {
      $id = $request->id;
      
      // Ensure you get the gaji record properly
      $gaji = Gaji::find($id);
      
      if (!$gaji) {
          return response()->json(['error' => 'Data gaji tidak ditemukan.'], 404);
      }
      
      // Convert date to Carbon instance if required
      $gaji->tanggal_penggajian = \Carbon\Carbon::parse($gaji->tanggal_penggajian);
      
      $jabatans = Jabatan::all(); // Get all jabatan data

      return view('gaji.edit', compact('gaji', 'jabatans'));
  }

  public function update(Request $request, $id)
  {
      // Validate the incoming data
      $validatedData = $request->validate([
          'tanggal_penggajian' => 'required|date',
          'tunjangan' => 'required|numeric|min:0',
          'potongan' => 'required|numeric|min:0',
      ], [
          'tanggal_penggajian.required' => 'Tanggal penggajian harus diisi.',
          'tanggal_penggajian.date' => 'Tanggal penggajian harus dalam format tanggal yang valid.',
          'tunjangan.required' => 'Tunjangan harus diisi.',
          'tunjangan.numeric' => 'Tunjangan harus berupa angka.',
          'tunjangan.min' => 'Tunjangan tidak boleh kurang dari 0.',
          'potongan.required' => 'Potongan harus diisi.',
          'potongan.numeric' => 'Potongan harus berupa angka.',
          'potongan.min' => 'Potongan tidak boleh kurang dari 0.',
      ]);

      // Find the gaji (salary) record by its ID
      $gaji = Gaji::find($id);

      // Check if the gaji record exists
      if (!$gaji) {
          return redirect()->route('gaji.gaji')->with('error', 'Data gaji tidak ditemukan.');
      }

       // Get the related karyawan (employee) to fetch the jabatan and gaji pokok (basic salary)
    $karyawan = Karyawan::find($gaji->karyawan_id);

    if (!$karyawan) {
        return redirect()->route('gaji.index')->with('error', 'Karyawan tidak ditemukan.');
    }

    // Get the jabatan (position) of the karyawan to fetch the gaji pokok (basic salary)
    $jabatan = $karyawan->jabatan;

    if (!$jabatan) {
        return redirect()->route('gaji.gaji')->with('error', 'Jabatan karyawan tidak ditemukan.');
    }

    // Calculate gaji bersih (net salary)
    $gaji_pokok = $jabatan->gaji_pokok; // Gaji pokok from Jabatan table
    $tunjangan = $validatedData['tunjangan']; // Tunjangan from validated data
    $potongan = $validatedData['potongan']; // Potongan from validated data

    $gaji_bersih = $gaji_pokok + $tunjangan - $potongan;

    // Update gaji data
    $gaji->tanggal_penggajian = $validatedData['tanggal_penggajian'];
    $gaji->total_tunjangan = $tunjangan;
    $gaji->total_potongan = $potongan;
    $gaji->gaji_bersih = $gaji_bersih;

    // Save the updated data to the database
    $gaji->save();

      // Redirect back to the gaji index with appropriate success or error message
      if ($gaji) {
          return redirect()->route('gaji.gaji')->with('success', 'Data Gaji berhasil diperbarui.');
      } else {
          return redirect()->route('gaji.gaji')->with('error', 'Data Gaji gagal diperbarui.');
      }
  }

  public function getJabatan($id)
  {
      // Get karyawan with their related jabatan
      $karyawan = Karyawan::with('jabatan')->find($id);

      if ($karyawan && $karyawan->jabatan) {
          return response()->json([
              'id' => $karyawan->jabatan->id,
              'nama_jabatan' => $karyawan->jabatan->nama_jabatan
          ]);
      }

      return response()->json(null);
  }


  //slip gaji
  public function slipgaji()
  {
        $gaji = Gaji::with('karyawan.jabatan')
        ->orderBy('gaji_bersih', 'desc')
        ->get();

        // Ambil data karyawan dan jabatan (data ini mungkin tidak diperlukan jika hanya untuk keperluan form)
        $karyawans = Karyawan::all();
        $jabatans = Jabatan::all();


        return view('gaji.slipgaji', compact('karyawans', 'jabatans', 'gaji'));
  }

public function cetakpdf($id)
{
    $gaji = Gaji::with('karyawan.jabatan')->find($id);

    if (!$gaji) {
        return redirect()->route('gaji.slipgaji')->with('error', 'Data gaji tidak ditemukan.');
    }

    // Load the view for the PDF
    $pdf = new Mpdf();
    $html = view('gaji.cetakpdf', compact('gaji'))->render();
    $pdf->WriteHTML($html);
    
    // Output the PDF
    return $pdf->Output('Slip_Gaji_' . $gaji->karyawan->nama . '.pdf', 'D');
}

public function downloadAllPdf()
{
    // Ambil semua data gaji
    $gajiList = Gaji::with('karyawan.jabatan')->get();

    if ($gajiList->isEmpty()) {
        return redirect()->route('gaji.slipgaji')->with('error', 'Tidak ada data gaji untuk diunduh.');
    }

    // Buat file ZIP sementara
    $zipFileName = 'slip_gaji_all.zip';
    $zip = new ZipArchive();
    $zipPath = storage_path('app/public/' . $zipFileName);

    if ($zip->open($zipPath, ZipArchive::CREATE) !== true) {
        return redirect()->route('gaji.slipgaji')->with('error', 'Tidak dapat membuat file ZIP.');
    }

    foreach ($gajiList as $gaji) {
        $pdf = new Mpdf();
        $html = view('gaji.cetakpdf', compact('gaji'))->render();
        $pdf->WriteHTML($html);
        $pdfContent = $pdf->Output('', 'S'); // Output PDF as a string

        // Nama file PDF untuk setiap slip gaji
        $pdfFileName = 'Slip_Gaji_' . $gaji->karyawan->nama . '.pdf';
        $zip->addFromString($pdfFileName, $pdfContent);
    }

    $zip->close();

    // Return file ZIP untuk diunduh
    return response()->download($zipPath)->deleteFileAfterSend(true);
}


}
