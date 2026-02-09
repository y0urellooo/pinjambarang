<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\ActivityLog;
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

        // Ambil user dulu berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Cek status
        if ($user && $user->status === 'nonactive') {
            return back()->withErrors([
                'email' => 'Login ditolak. Status akun Anda tidak aktif. Hubungi administrator jika ini adalah kesalahan.'
            ]);
        }

        // Baru attempt login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Log aktivitas login
            ActivityLog::log('login', "User masuk: {$user?->name}", 'Auth');

            return $this->redirectByRole();
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'no_telpon' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fotoName = null;

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoName = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('foto_peminjam'), $fotoName);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'peminjam',
            'status' => 'active',

            'no_telpon' => $request->no_telpon,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'foto' => $fotoName,
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil');
    }

    public function logout(Request $request)
    {
        // Log aktivitas logout (sebelum logout agar auth()->id() tersedia)
        ActivityLog::log('logout', "User keluar: " . auth()->user()?->name, 'Auth');

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    // ===== REDIRECT ROLE =====
    private function redirectByRole()
    {
        return match (auth()->user()->role) {
            'admin' => redirect('/admin/dashboard'),
            'petugas' => redirect('/petugas/dashboard'),
            'peminjam' => redirect('/peminjam/dashboard'),
            default => redirect('/login'),
        };
    }
}
