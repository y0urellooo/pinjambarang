<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ===== FORM =====
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    // ===== ACTION =====
   public function login(Request $request)
{
    $credentials = $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        return match (Auth::user()->role) {
            'admin'     => redirect('/admin/dashboard'),
            'petugas'   => redirect('/petugas/dashboard'),
            'peminjam'  => redirect('/peminjam/dashboard'),
            default     => redirect('/login'),
        };
    }

    return back()->withErrors([
        'email' => 'Email atau password salah',
    ]);




        return back()->withErrors([
            'email' => 'Email atau password salah',
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'peminjam', // default
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil');
    }

  public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
}

    // ===== REDIRECT ROLE =====
    private function redirectByRole()
    {
        return match (Auth::user()->role) {
            'admin'     => redirect('/admin/dashboard'),
            'petugas'   => redirect('/petugas/dashboard'),
            'peminjam'  => redirect('/peminjam/dashboard'),
            default     => redirect('/login'),
        };
    }
}
