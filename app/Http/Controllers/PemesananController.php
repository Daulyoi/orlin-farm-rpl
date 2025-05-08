<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pemesanan;
use App\Models\ItemPemesanan;
use App\Models\Keranjang;


class PemesananController extends Controller
{
    public function showAll(Request $request)
    {
        $sortBy = $request->input('sort_by', 'created_at');
        $sortOrder = $request->input('sort_order', 'desc');
        
        $query = Pemesanan::with('pelanggan', 'itemPemesanans.hewanQurban', 'pembayaran');
    
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }
    
        if ($request->filled('pelanggan_nama')) {
            $query->whereHas('pelanggan', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->input('pelanggan_nama') . '%');
            });
        }
    
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->input('date_from'));
        }
    
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->input('date_to'));
        }
    
        $pemesanans = $query->orderBy($sortBy, $sortOrder)->paginate(10);
    
        return view('admin.pemesanan', ['pemesanans' => $pemesanans]);
    }    
    
    public function showMine(Request $request)
    {
        $pelanggan_id = session('pelanggan_id');
    
        $sortBy = $request->input('sort_by', 'created_at');
        $sortOrder = $request->input('sort_order', 'desc');
    
        $query = Pemesanan::where('id_pelanggan', $pelanggan_id)
            ->with('itemPemesanans.hewanQurban');
    
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }
    
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->input('date_from'));
        }
    
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->input('date_to'));
        }
    
        $pemesanans = $query->orderBy($sortBy, $sortOrder)->paginate(10);
    
        return view('pemesanan.index', ['pemesanans' => $pemesanans]);
    }
    
    
    public function show(string $pemesanan_id)
    {
        $pemesanan = Pemesanan::findOrFail($pemesanan_id);
        return view('pemesanan.detail', [
            'pemesanan'=> $pemesanan
        ]);
    }
    
    public function createFromKeranjang()
    {
        try 
        {
            DB::beginTransaction();
    
            $pelanggan_id = session('pelanggan_id');
            $keranjang_items = Keranjang::where('id_pelanggan', $pelanggan_id)->get();
    
            if ($keranjang_items->isEmpty()) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Pemesanan gagal dibuat.');
            }

            $jumlah_harga = 0;
            foreach ($keranjang_items as $keranjang_item) {
                if ($keranjang_item->hewanQurban->tersedia == 'tidak') {
                    DB::rollBack();
                    return redirect()->back()->with('error', 'Pemesanan gagal dibuat.');
                }
                $jumlah_harga += $keranjang_item->hewanQurban->harga;
            }
    
            $pemesanan = Pemesanan::create([
                'id_pelanggan' => $pelanggan_id,
                'tanggal' => now(),
                'status' => 'pending',
                'jumlah' => $jumlah_harga,
            ]);
    
            foreach ($keranjang_items as $keranjang_item) {
                $keranjang_item->hewanQurban->update(['tersedia' => 'tidak']);
    
                ItemPemesanan::create([
                    'id_pemesanan' => $pemesanan->id,
                    'id_hewan' => $keranjang_item->id_hewan,
                ]);
            }
    
            Keranjang::where('id_pelanggan', $pelanggan_id)->delete();
    
            DB::commit();
    
            return redirect()->route('pelanggan.pemesanan')->with('success', 'Pemesanan berhasil dibuat.');
        } 
        catch (\Illuminate\Validation\ValidationException $e) 
        {
            DB::rollBack();
            return response()->json(['errors' => $e->validator->errors()], 422);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            return response()->json(['message' => 'Gagal membuat pemesanan.', 'error' => $e->getMessage()], 500);
        }
    }    

    // WIP
    public function updateStatusByAdmin(Request $request, string $pemesanan_id)
    {
        try {
            DB::beginTransaction();
    
            $validatedData = $request->validate([
                'status' => 'required|in:pending,processing,completed,cancelled',
            ]);
    
            $pemesanan = Pemesanan::findOrFail($pemesanan_id);
    
            $pemesanan->update($validatedData + ['id_admin' => session('admin_id')]);
    
            DB::commit();
    
            return response()->json(['message' => 'Pemesanan berhasil diperbarui', 'pemesanan' => $pemesanan], 200);
    
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return response()->json(['errors' => $e->validator->errors()], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Gagal memperbarui status pemesanan', 'error' => $e->getMessage()], 500);
        }
    }

    public function cancel(string $pemesanan_id) {
        try {
            DB::beginTransaction();
    
            $pemesanan = Pemesanan::findOrFail($pemesanan_id);

            if ($pemesanan->id_pelanggan != session('pelanggan_id'))
            {
                return response()->json(['message' => 'Login dlu bang'], 400);
            }
    
            $pemesanan->update([
                'status' => 'cancelled',
            ]);

            foreach ($pemesanan->itemPemesanans as $item) {
                $item->hewanQurban->update(['tersedia' => 'tersedia']);
            }
    
            DB::commit();
    
            return redirect()->back()->with('success', 'Pemesanan berhasil dibatalkan');
    
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return response()->json(['errors' => $e->validator->errors()], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Gagal memperbarui status pemesanan', 'error' => $e->getMessage()], 500);
        }
    }
    
    // WIP
    public function destroy(string $pemesanan_id)
    {
        $pemesanan = Pemesanan::findOrFail($pemesanan_id);
        $pemesanan->delete();
        return response()->json(['message' => 'Pemesanan berhasil dihapus']);
    }
}
