<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan form register
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Proses register
    public function register(Request $request)
    {
        // Validasi input yang diterima dari form register
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:admin,user', // Validasi role harus 'admin' atau 'user'
        ]);

        // Jika validasi lolos, buat pengguna baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role, // Role yang dipilih saat register
        ]);

        // Redirect ke halaman login setelah registrasi berhasil
        return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
    }

    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input login
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek kredensial, jika cocok login
        if (Auth::attempt($credentials)) {
            // Generate session baru
            $request->session()->regenerate();

            // Cek role, jika admin arahkan ke admin dashboard
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard'); // Redirect ke admin dashboard
            }

            return redirect()->intended('dashboard'); // Redirect ke user dashboard
        }

        // Jika gagal login, kembali ke halaman login
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Menampilkan dashboard
    public function dashboard()
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // Jika belum login, arahkan ke login
        }

        $user = Auth::user();

        // Jika role adalah admin, tampilkan dashboard admin
        if ($user->role === 'admin') {
            return view('dashboard.admin');
        }

        // Jika bukan admin, tampilkan dashboard user biasa
        return view('dashboard.user');
    }

    // Logout
    public function logout(Request $request)
    {
        // Melakukan logout
        Auth::logout();

        // Hapus session dan regenerasi token CSRF untuk keamanan
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman login setelah logout
        return redirect()->route('login');
    }

    // Menampilkan halaman dashboard admin
    public function adminDashboard()
    {
        // Cek apakah user memiliki role 'admin'
        if (Auth::check() && Auth::user()->role === 'admin') {
            $totalUsers = User::count();
            $totalBooks = Book::count();
            return view('admin.dashboard', compact('totalUsers', 'totalBooks'));
        }
        
        return redirect()->route('dashboard');  // Arahkan ke halaman dashboard biasa
    }
}
