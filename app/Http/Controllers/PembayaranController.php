<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pemesanan;
use App\Models\Pembayaran;
use App\Models\ItemPemesanan;
use App\Models\Hewan;


class PembayaranController extends Controller
{
    public function showAll()
    {
        $pemesanans = Pemesanan::with('itemPemesanans.hewanQurban')->get();
        return view('admin.pembayaran', [
            'pemesanans'=> $pemesanans
        ]);
    }
    
    public function showMine()
    {
        $pelanggan_id = session('pelanggan_id');
        $pemesanans = Pemesanan::where('id_pelanggan', $pelanggan_id)->get();
        $pembayarans = $pemesanans->pluck('pembayaran')->filter();
        return view('pembayaran.index', [
            'pembayarans'=> $pembayarans
        ]);
    }

    public function show(string $pembayaran_id)
    {
        $pembayaran = Pembayaran::findOrFail($pembayaran_id);
        if ($pembayaran->pemesanan->id_pelanggan != session('pelanggan_id')){
            return redirect()->back();
        }
        return view('pembayaran.detail', [
            'pembayaran'=> $pembayaran
        ]);
    }

    public function create(Request $request) 
    {
        try
        {
            DB::beginTransaction();
            $validatedData = $request->validate([
                'id_pemesanan' => 'required|exists:pemesanans,id',
                'metode' => 'required|in:qris,transfer',
                'bukti' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120'
            ]);
            $pelanggan_id = session('pelanggan_id');
            $pemesanan = Pemesanan::findOrFail($validatedData['id_pemesanan']);
            if ($pemesanan->pelanggan->id != $pelanggan_id) {
                return redirect()->back()->with('error', 'Pembayaran gagal dibuat');
            }
            $itemPemesanans = ItemPemesanan::where('id_pemesanan', $validatedData['id_pemesanan'])->get();
            $jumlah = 0;

            foreach($itemPemesanans as $itemPemesanan) {
                $hargaHewan = $itemPemesanan->hewanQurban->harga;
                $jumlah += $hargaHewan;
            }
            
            $image = $request->file('bukti');
            $extension = $image->getClientOriginalExtension();
            $filename = time() . '_' . $pelanggan_id . '.' . $extension;
            $path = $image->storeAs('proofs', $filename, 'public');


            $pembayaran = Pembayaran::create([
                'metode' => $validatedData['metode'],
                'jumlah' => $jumlah,
                'tanggal' => now(),
                'status' => 'waiting',
                'bukti' => $path,
                'id_pemesanan' => $validatedData['id_pemesanan'],
            ]);
            DB::commit();
            return redirect()->back()->with('success', 'Pembayaran berhasil dibuat');
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

    public function updateStatus(Request $request, string $pembayaran_id)
    {
        try 
        {
            DB::beginTransaction();
            $pembayaran = Pembayaran::findOrFail($pembayaran_id);
            $admin_id =  session(('admin_id'));
            $validatedData = $request->validate([
                'status' => 'required|in:accepted,rejected'
            ]);
            $pembayaran->update($validatedData + ['id_admin' => $admin_id]);
            DB::commit();
            return response()->json(['message' => 'Status pembayaran berhasil diperbarui', 'pembayaran' => $pembayaran], 200);
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
