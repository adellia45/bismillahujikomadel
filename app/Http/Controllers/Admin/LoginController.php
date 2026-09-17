<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;    

class LoginController extends Controller
{
    //untuk menampilkan halaman login
    public function showLoginForm(){
        return view("admin.login");
    }
    //memproses login
    public function login(Request $request)
    {
        //validasi input
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required'=> 'Nama pengguna wajib diisi.',
            'password.required'=> 'Kata sandi wajib diisi',
        ]);

        //cek bukti ke database
        if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();

            //berhasillogin
            return redirect()->intended(route('admin.dashboard'));
    }

    //kalogagal
    return back()->withErrors([
        'username' => 'Nama pengguna atau kata sandi salah.',
    ])->onlyInput('username');
    }
    //logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}