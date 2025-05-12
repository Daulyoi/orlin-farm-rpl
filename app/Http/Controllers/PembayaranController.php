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
    public function showAll(Request $request)
    {
        $sortBy = $request->input('sort_by', 'created_at');
        $sortOrder = $request->input('sort_order', 'desc');

        $query = Pembayaran::with('pemesanan.pelanggan', 'pemesanan.itemPemesanans.hewanQurban');

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('pelanggan_nama')) {
            $query->whereHas('pemesanan.pelanggan', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->input('pelanggan_nama') . '%');
            });
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->input('date_from'));
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->input('date_to'));
        }

        $pembayarans = $query->orderBy($sortBy, $sortOrder)->paginate(10);

        return view('admin.pembayaran', [
            'pembayarans' => $pembayarans
        ]);
    }

    public function showMine(Request $request)
    {
        trackVisit();
        $pelanggan_id = session('pelanggan_id');

        $sortBy = $request->input('sort_by', 'created_at');
        $sortOrder = $request->input('sort_order', 'desc');

        $query = Pembayaran::whereHas('pemesanan', function ($q) use ($pelanggan_id) {
            $q->where('id_pelanggan', $pelanggan_id);
        })->with('pemesanan');

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->input('date_from'));
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->input('date_to'));
        }

        $pembayarans = $query->orderBy($sortBy, $sortOrder)->paginate(10);

        return view('pembayaran.index', [
            'pembayarans' => $pembayarans
        ]);
    }


    public function show(string $pembayaran_id)
    {
        $pembayaran = Pembayaran::findOrFail($pembayaran_id);
        $pelanggan_id = currentPelanggan()->id;
        if ($pembayaran->pemesanan->id_pelanggan != $pelanggan_id){
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
            $pelanggan_id = currentPelanggan()->id;
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
