<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pemesanan;
use App\Models\ItemPemesanan;
use App\Models\Keranjang;


class PemesananController extends Controller
{
    public function index(Request $request)
    {
        trackVisit();
        
        $query = Pemesanan::where('id_pelanggan', currentPelanggan()->id)
            ->with('itemPemesanans')
            ->with('itemPemesanans.hewanQurban')
            ->with('pembayaran');
        
        // Search functionality
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('alamat', 'like', '%' . $search . '%')
                  ->orWhere('status', 'like', '%' . $search . '%')
                  ->orWhere(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), 'like', '%' . $search . '%')
                  ->orWhereHas('itemPemesanans.hewanQurban', function ($hewanQuery) use ($search) {
                      $hewanQuery->where('jenis', 'like', '%' . $search . '%');
                  });
            });
        }
        
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }
        
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->input('date_from'));
        }
        
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->input('date_to'));
        }
        
        $sortBy = $request->input('sort_by', 'created_at');
        $sortOrder = $request->input('sort_order', 'desc');

        $pemesanans = $query->orderBy($sortBy, $sortOrder)->paginate(10);
        
        return view('pelanggan.pemesanan.index', ['pemesanans' => $pemesanans]);
    }
    
    public function show(string $pemesanan_id)
    {
        $pemesanan = Pemesanan::where('id', $pemesanan_id)
            ->where('id_pelanggan', currentPelanggan()->id)
            ->with('itemPemesanans.hewanQurban')
            ->firstOrFail();
            
        return view('pelanggan.pemesanan.show', compact('pemesanan'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telp' => 'required|string|max:15',
        ]);

        $pelanggan_id = currentPelanggan()->id;

        $keranjang = currentPelanggan()->keranjangs;

        if ($keranjang->isEmpty()) {
            return redirect()->back()->with('error', 'Pemesanan gagal dibuat.');
        }

        $jumlah_harga = 0;
        foreach ($keranjang as $item) {
            if ($item->hewanQurban->tersedia == 'tidak') {
                return redirect()->back()->with('error', 'Pemesanan gagal dibuat.');
            }
            $jumlah_harga += $item->hewanQurban->harga;
        }

        $pemesanan = Pemesanan::create([
            'id_pelanggan' => $pelanggan_id,
            'tanggal' => now(),
            'expired_at' => now()->addHours(24),
            'status' => 'pending',
            'nama' => $validatedData['nama'],
            'alamat' => $validatedData['alamat'],
            'no_telp' => $validatedData['no_telp'],
            'jumlah' => $jumlah_harga,
        ]);

        foreach ($keranjang as $item) {
            $item->hewanQurban->update(['tersedia' => 'tidak']);

            ItemPemesanan::create([
                'id_pemesanan' => $pemesanan->id,
                'id_hewan' => $item->id_hewan,
            ]);
        }

        foreach ($keranjang as $item) {
            $item->delete();
        }

        return redirect()->route('pelanggan.pembayaran.create', ['id_pemesanan' => $pemesanan->id])->with('success', 'Pemesanan berhasil dibuat.');
    }

    public function cancel(string $pemesanan_id) {
        $pemesanan = Pemesanan::findOrFail($pemesanan_id);
        if ($pemesanan->id_pelanggan !== currentPelanggan()->id) {
            abort(403, 'Unauthorized action.');
        }
        if ($pemesanan->status !== 'pending' || $pemesanan->pembayaran()->exists()) {
            // Jika pemesanan sudah diproses atau sudah ada pembayaran, tidak bisa dibatalkan
            return redirect()->back()->with('error', 'Pemesanan tidak dapat dibatalkan.');
        }
        $pemesanan->update([
            'status' => 'cancelled',
        ]);
        foreach ($pemesanan->itemPemesanans as $item) {
            $item->hewanQurban->update(['tersedia' => 'tersedia']);
        }
        return redirect()->back()->with('success', 'Pemesanan berhasil dibatalkan');
    }

    public function destroy(Pemesanan $pemesanan)
    {
        $pemesanan->delete();
        foreach ($pemesanan->itemPemesanans as $item) {
            $item->hewanQurban->update(['tersedia' => 'tersedia']);
        }
        return redirect()->back()->with('success', 'Pemesanan berhasil dihapus');
    }
}
