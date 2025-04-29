<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PelangganController extends Controller
{
    public function showRegisterForm(){
        return view('auth.register');
    }

    public function register(Request $request){
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:pelanggans',
            'password' => 'required|string|min:8|confirmed',
            'alamat' => 'nullable|string|max:255',
        ]);


        Pelanggan::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'alamat' => $request->alamat,
        ]);

        // dd($request->all());
        return redirect()->back()->with('success', 'Pendaftaran berhasil! Silakan login.');
    }

    public function updateProfile(Request $request, $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pelanggans,email,' . $pelanggan->id,
            'password' => 'nullable|string|min:8|confirmed',
            'alamat' => 'nullable|string',
        ]);

        $pelanggan->nama = $request->nama;
        $pelanggan->email = $request->email;
        $pelanggan->alamat = $request->alamat;

        if ($request->filled('password')) {
            $pelanggan->password = Hash::make($request->password);
        }

        $pelanggan->save();

        return redirect()->back()->with('success', 'Profile updated!');
    }

    public function showLoginForm(){
        return view('auth.login');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);


        $pelanggan = Pelanggan::where('email', $request->email)->first();
        // dd($pelanggan->all());

        if ($pelanggan && Hash::check($request->password, $pelanggan->password)) {
            session(['pelanggan_id' => $pelanggan->id]);
            return redirect()->route('home')->with('success', 'Logged in successfully.');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('pelanggan_id');
        return redirect()->route('home')->with('success', 'Logged out.');
    }


}
