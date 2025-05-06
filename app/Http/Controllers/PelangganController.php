<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class PelangganController extends Controller
{
    public function showRegisterForm(){
        return view('auth.register');
    }

    public function register(Request $request){
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:pelanggans',
                'password' => 'required|string|min:8|confirmed',
                'alamat' => 'nullable|string|max:255',
                'no_telp' => 'required|string|max:15',
            ]);

            Pelanggan::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
            ]);

            return redirect()->back()->with('success', 'Pendaftaran berhasil! Silakan login.');
        }
        catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        }
        catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.')
                ->withInput();
        }
    }

    public function updateProfile(Request $request, $id)
    {
        try {
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
        catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        }
        catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui profil. Silakan coba lagi.')
                ->withInput();

        }
    }

    public function showLoginForm(){
        return view('auth.login');
    }

    public function login(Request $request){
        try {
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
        catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        }
        catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat login. Silakan coba lagi.')
                ->withInput();

        }
    }

    public function logout(Request $request)
    {
        try {
            $request->session()->forget('pelanggan_id');
            return redirect()->route('home')->with('success', 'Logged out.');
        }
        catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat logout. Silakan coba lagi.')
                ->withInput();
        }
    }


}
