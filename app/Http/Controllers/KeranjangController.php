<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;


class KeranjangController extends Controller
{   
    public function index() 
    {
        trackVisit();
        $keranjang = currentPelanggan()->keranjangs()->with('hewanQurban')->get();
        return view('pelanggan.keranjang.index', compact('keranjang'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_hewan' => 'required|exists:hewan_qurbans,id'
        ]);
        currentPelanggan()->keranjangs()->firstOrCreate([
            'id_hewan' => $validatedData['id_hewan']
        ]);
        return redirect()->back()->with('success', 'Item berhasil ditambahkan.');
    }

    public function destroy(string $keranjang_id)
    {
        $keranjang = Keranjang::findOrFail($keranjang_id);
        
        if (!$keranjang) {
            abort(404, message: 'Keranjang tidak ditemukan.');
        }
        if ($keranjang->id_pelanggan !== currentPelanggan()->id) {
            abort(403, message: $keranjang->id_pelanggan);
        }
        
        $keranjang->delete();
        return redirect()->back()->with('success', 'Item berhasil dihapus.');
    }
}
