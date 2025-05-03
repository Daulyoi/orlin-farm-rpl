<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pemesanan;
use App\Models\ItemPemesanan;
use App\Models\Keranjang;


class PemesananController extends Controller
{
    public function showAll()
    {
        $pemesanans = Pemesanan::with('pelanggan', 'itemPemesanans.hewanQurban', 'pembayaran')->get();
        return view('admin.pemesanan', ['pemesanans'=> $pemesanans]);
    }
    
    // DONE
    public function showMine()
    {
        $pelanggan_id = session('pelanggan_id');
        $pemesanans = Pemesanan::where('id_pelanggan', $pelanggan_id)->with('itemPemesanans.hewanQurban')->get();
        return view('pemesanan.index', ['pemesanans'=> $pemesanans]);
    }
    
    public function show(string $pemesanan_id)
    {
        $pemesanan = Pemesanan::findOrFail($pemesanan_id);
        $jumlah = 0;
        foreach($pemesanan->itemPemesanans as $item) {
            $hargaHewan = $item->hewanQurban->harga;
            $jumlah += $hargaHewan;
        }
        return view('pemesanan.detail', [
            'pemesanan'=> $pemesanan,
            'jumlah' => $jumlah
        ]);
    }
    
    public function createFromKeranjang()
    {
        try 
        {
            DB::beginTransaction();

            $pelanggan_id = session('pelanggan_id');
            $keranjangItems = Keranjang::where('id_pelanggan', $pelanggan_id)->get();

            if ($keranjangItems->isEmpty()) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Pemesanan gagal dibuat.');
            }
            
            foreach ($keranjangItems as $keranjangItem) {
                if ($keranjangItem->hewanQurban->tersedia == 'tidak') {
                    DB::rollBack();
                    return redirect()->back()->with('error', 'Pemesanan gagal dibuat.');
                }
            }

            $pemesanan = Pemesanan::create([
                'id_pelanggan' => $pelanggan_id,
                'tanggal' => now(),
                'status' => 'pending',
            ]);
            
            foreach ($keranjangItems as $keranjangItem) {
                $keranjangItem->hewanQurban->update(['tersedia' => 'tidak']);
                ItemPemesanan::create([
                    'id_pemesanan' => $pemesanan->id,
                    'id_hewan' => $keranjangItem->id_hewan,
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
