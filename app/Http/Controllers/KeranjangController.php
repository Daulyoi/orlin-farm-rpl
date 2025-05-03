<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use Illuminate\Support\Facades\DB;

class KeranjangController extends Controller
{   
    // DONE
    public function showMine() 
    {
        $pelanggan_id = session('pelanggan_id');
        $itemKeranjangs = Keranjang::where('id_pelanggan', $pelanggan_id)
            ->get();
        return view('keranjang', [
            'itemKeranjangs'=> $itemKeranjangs
        ]);
    }

    // DONE
    public function add(Request $request)
    {
        try
        {
            DB::beginTransaction();
            $pelanggan_id = session('pelanggan_id');
            if (!$pelanggan_id) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Item gagal ditambahkan.');
            }
            $validatedData = $request->validate([
                'id_hewan' => 'required|exists:hewan_qurbans,id'
            ]);

            $itemKeranjangs = Keranjang::where('id_pelanggan', $pelanggan_id)->where('id_hewan', $validatedData['id_hewan'])->exists();
            if ($itemKeranjangs) {
                return redirect()->back()->with('error', 'Item gagal ditambahkan');
            }
            $itemKeranjang = Keranjang::create([
                'id_pelanggan' => $pelanggan_id,
                'id_hewan' => $validatedData['id_hewan']
            ]);
            DB::commit();
            return redirect()->back()->with('success', 'Item berhasil ditambahkan.');
        }
        catch (\Illuminate\Validation\ValidationException $e) 
        {
            DB::rollBack();
            return response()->json(['errors' => $e->validator->errors()], 422);
        } 
        catch (\Exception $e) 
        {
            DB::rollBack();
            return response()->json(['message' => 'Gagal memperbarui status pembayaran', 'error' => $e->getMessage()], 500);
        }
    }
    
    // DONE
    public function delete(Request $request)
    {
        try {
            DB::beginTransaction();
            $pelanggan_id = session('pelanggan_id');
            if (!$pelanggan_id) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Item gagal dihapus.');
            }
            $keranjang_id = $request['keranjang_id'];
            $itemKeranjang = Keranjang::findOrFail($keranjang_id);
            if ($pelanggan_id != $itemKeranjang->id_pelanggan) {
                return redirect()->back()->with('error', 'Item gagal dihapus.');
            }
            $itemKeranjang->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Item berhasil dihapus.');
        }
        catch (\Illuminate\Validation\ValidationException $e) 
        {
            DB::rollBack();
            return response()->json(['errors' => $e->validator->errors()], 422);
        } 
        catch (\Exception $e) 
        {
            DB::rollBack();
            return response()->json(['message' => 'Gagal memperbarui status pembayaran', 'error' => $e->getMessage()], 500);
        }
    }
}
