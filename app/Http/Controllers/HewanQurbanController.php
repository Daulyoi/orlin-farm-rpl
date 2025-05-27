<?php

namespace App\Http\Controllers;

use App\Models\HewanQurban;
use Illuminate\Http\Request;

class HewanQurbanController extends Controller
{
    public function showAll(Request $request)
    {
        trackVisit();
        $sortBy = $request->input('sort_by', 'created_at');
        $sortOrder = $request->input('sort_order', 'desc');

        $query = HewanQurban::query();

        $query->where('tersedia', 'tersedia');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('jenis', 'like', '%' . $search . '%')
                  ->orWhere('lokasi', 'like', '%' . $search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('kelamin')) {
            $query->where('kelamin', $request->input('kelamin'));
        }

        $query->orderBy($sortBy, $sortOrder);

        $hewanQurbans = $query->paginate(8);

        return view('landingpage.landingpage', ['hewanQurbans' => $hewanQurbans]);
    }


    public function showOne($id){
        trackVisit();
        $hewanQurban = HewanQurban::find($id);
        return view('hewanQurban.detail', ['hewanQurban' => $hewanQurban]);
    }

    public function updateHarga($id, Request $request){
        $hewanQurban = HewanQurban::find($id);
        $hewanQurban->harga = $request->harga;
        $hewanQurban->save();

        return redirect()->back()->with('success', 'Harga berhasil diupdate!');
    }

    public function updateStatus($id, Request $request){
        $hewanQurban = HewanQurban::find($id);
        $hewanQurban->tersedia = $request->tersedia;
        $hewanQurban->save();

        return redirect()->back()->with('success', 'Status berhasil diupdate!');
    }

    public function updateProfil(Request $request){
        $hewanQurban = HewanQurban::find($request->id);
        $hewanQurban->jenis = $request->jenis;
        $hewanQurban->bobot = $request->bobot;
        $hewanQurban->kelamin = $request->kelamin;
        $hewanQurban->deskripsi = $request->deskripsi;
        $hewanQurban->lokasi = $request->lokasi;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $hewanQurban->foto = 'images/' . $filename;
        }

        $hewanQurban->save();

        return redirect()->back()->with('success', 'Profil hewan qurban berhasil diupdate!');
    }
}
