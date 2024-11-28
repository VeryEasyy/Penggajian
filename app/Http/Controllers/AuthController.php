<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(){

        return view('auth.login');
    }
    public function proseslogin(Request $request){
        
      $auth =  $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        if (Auth::attempt($auth)){
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->with('loginError', 'Login Failed, Coba Lagi!');
        
    }

    public function register()
    {

        return view('auth.register');
    }

    public function ProsesRegister(Request $request)
    {
          // Validasi data yang dikirimkan
          $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        // Jika validasi gagal, kembalikan ke formulir dengan pesan error
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {   
            // Buat pengguna baru
            User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Redirect ke halaman login dengan pesan sukses
            return redirect('/')->with('success', 'Registrasi berhasil! Silakan login.');
        } catch (\Exception $e) {
            // Tangani jika terjadi error saat menyimpan data
            return redirect()->back()->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }
}
