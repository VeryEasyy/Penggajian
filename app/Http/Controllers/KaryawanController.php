<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class KaryawanController extends Controller
{
    public function karyawan()
    {
        // $karyawans = Karyawan::with(['user', 'jabatan', 'gaji'])->get();
        $karyawans = Karyawan::with('jabatan')
        ->join('jabatans', 'karyawans.jabatan_id', '=', 'jabatans.id') // Gunakan 'jabatans' jika itu nama tabel yang benar
        ->orderBy('jabatans.gaji_pokok', 'desc') // Urutkan berdasarkan gaji_pokok dari tabel jabatans
        ->select('karyawans.*') // Pilih semua kolom dari tabel karyawans
        ->get();
        
        $jabatans = Jabatan::all();
        
        return view('karyawan.karyawan', compact('karyawans','jabatans'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan_id' => 'required|exists:jabatans,id',
            'alamat' => 'required|string|max:255',
            'tanggal_masuk' => 'required|date',
            'no_telepon' => 'required|string|max:15',
            'status_karyawan' => 'required|in:Kontrak,Tetap'
        ]);

        try {
            Karyawan::create($validatedData);
            return redirect('/karyawan')->with('success', 'Karyawan berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect('/karyawan')->with('error', 'Gagal menambahkan Karyawan: ' . $e->getMessage());
        }
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $karyawan = DB::table('karyawans')->where('id', $id)->first();

           // Pastikan tanggal_masuk adalah objek Carbon
         $karyawan->tanggal_masuk = \Carbon\Carbon::parse($karyawan->tanggal_masuk);
    
        $jabatans = Jabatan::all(); // Ambil semua jabatan untuk dropdown
    
        return view('karyawan.edit', compact('karyawan', 'jabatans'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input data
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan_id' => 'required|exists:jabatans,id',
            'alamat' => 'required|string|max:255',
            'tanggal_masuk' => 'required|date',
            'no_telepon' => 'required|string|max:15',
            'status_karyawan' => 'required|in:Kontrak,Tetap'
        ]);
    
        try {
            // Update data karyawan berdasarkan ID
            $update = Karyawan::where('id', $id)->update($validatedData);
    
            if ($update) {
                return redirect()->route('karyawan')->with('success', 'Data karyawan berhasil diperbarui.');
            } else {
                return redirect()->route('karyawan')->with('error', 'Data karyawan gagal diperbarui.');
            }
        } catch (\Exception $e) {
            return redirect()->route('karyawan')->with('error', 'Gagal memperbarui data karyawan: ' . $e->getMessage());
        }
    }

    public function delete($id){
        try {
            $karyawan = Karyawan::findOrFail($id); // Menggunakan Eloquent untuk mencari data
            $karyawan->delete(); // Menghapus data
    
            return redirect()->route('karyawan')->with('success', 'Berhasil menghapus data karyawan: ');
        } catch (\Exception $e) {
            return redirect()->route('karyawan')->with('error', 'Gagal menghapus data karyawan: ' . $e->getMessage());
        }
    }
}