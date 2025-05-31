<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class PelangganController extends Controller
{
    public function showRegisterForm(){
        return view('register.register');
    }

    public function register(Request $request){
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:pelanggans',
            'password' => 'required|string|min:8|max:20|confirmed',
            'alamat' => 'nullable|string',
            'no_telp' => 'required|string|max:15',
        ]);
        $pelanggan= Pelanggan::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
        ]);
        return redirect()->intended('/')->with('success', 'Registration successful! Please login.');
    }

    public function updateProfile(Request $request, $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pelanggans,email,' . $pelanggan->id,
            'password' => 'nullable|string|min:6|confirmed',
            'alamat' => 'nullable|string',
            'no_telp' => 'required|string|max:15',
        ]);

        $pelanggan->nama = $request->nama;
        $pelanggan->email = $request->email;
        $pelanggan->alamat = $request->alamat;
        $pelanggan->no_telp = $request->no_telp;

        if ($request->filled('password')) {
            $pelanggan->password = Hash::make($request->password);
        }

        $pelanggan->save();

        return redirect()->back()->with('success', 'Profile updated!');
    }

    public function showLoginForm(){
        return view('login.login');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);


        if (Auth::guard('pelanggan')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            return redirect()->route('home')->with('success', 'Logged in successfully.');
        }
        else {
            return redirect()->back()->with('error','Login failed. Please check your credentials.')->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('pelanggan')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Logged out successfully.');
    }


}
