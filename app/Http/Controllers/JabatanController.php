<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;

class JabatanController extends Controller
{
    public function jabatan()
    {
        $jabatans = Jabatan::orderBy('gaji_pokok', 'desc')->get();
        return view('jabatan.jabatan', compact('jabatans'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_jabatan' => 'required|string|max:255',
            'gaji_pokok' => 'required|numeric',
        ]);

        try {
            Jabatan::create($validatedData);
            return redirect()->route('jabatan.jabatan')->with('success', 'Jabatan berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->route('jabatan.jabatan')->with('error', 'Gagal menambahkan Jabatan.');
        }
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $jabatan = DB::table('jabatans')->where('id', $id)->first();
        return view('jabatan.edit', compact('jabatan'));
    }

    public function update(Request $request, $id)
    {
        $id = $request->id;
        $nama = $request->nama_jabatan;
        $gaji = $request->gaji_pokok;


        try {
            $data = [
                'id' => $id,
                'nama_jabatan' => $nama,
                'gaji_pokok' => $gaji
            ];
            $update = DB::table('jabatans')->where('id',$id)->update($data);

            if($update) {
                return redirect()->route('jabatan.jabatan')->with('success', 'Jabatan berhasil diedit');
            }

        } catch (\Exception $e) {
            return redirect()->route('jabatan.jabatan')->with('error', 'Gagal mengedit Jabatan.');
            
        }
    }
    public function delete($id){
        try {
            $jabatan = Jabatan::findOrFail($id); // Menggunakan Eloquent untuk mencari data
            $jabatan->delete(); // Menghapus data
    
            return redirect()->route('jabatan.jabatan')->with('success', 'Berhasil Menghapus Data Jabatan.');
        } catch (\Exception $e) {
            return redirect()->route('jabatan.jabatan')->with('error', 'Gagal Menghapus Data Jabatan.');
        }
    }

}
