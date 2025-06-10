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
    public function index(Request $request)
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

        return view('pelanggan.pembayaran.index', [
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
        return view('pelanggan.pembayaran.show', [
            'pembayaran'=> $pembayaran
        ]);
    }

    public function store(Request $request)
    {
            $validatedData = $request->validate([
                'id_pemesanan' => 'required|exists:pemesanans,id',
                'metode' => 'required|in:qris,transfer_mandiri,transfer_bsi,transfer_bca,transfer_bni,transfer_bri',
                'bukti' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120'
            ]);
            $pelanggan_id = currentPelanggan()->id;
            $pemesanan = Pemesanan::findOrFail($validatedData['id_pemesanan']);
            if ($pemesanan->pelanggan->id != $pelanggan_id) {
                abort(403, 'Unauthorized action.');
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
                'metode' => $validatedData['metode'], // Use the selected method from form
                'jumlah' => $jumlah,
                'tanggal' => now(),
                'status' => 'waiting',
                'bukti' => $path,
                'id_pemesanan' => $validatedData['id_pemesanan'],
            ]);
            return redirect()->route("pelanggan.pemesanan.index")->with('success', 'Pembayaran berhasil dibuat');
    }

    public function create(string $id_pemesanan)
    {
        $pemesanan = Pemesanan::find($id_pemesanan);

        // Handle jika pemesanan tidak ditemukan
        if (!$pemesanan) {
            return redirect()->route('home');
        }

        // Pastikan hanya pelanggan yang sesuai yang bisa mengakses
        if ($pemesanan->id_pelanggan !== currentPelanggan()->id) {
            return redirect()->route('home');
        }

        return view('pelanggan.pembayaran.create', [
            'pemesanan' => $pemesanan
        ]);
    }
}
