<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paket;
use App\Models\Hotel;
use App\Models\Itinerari;
use App\Models\Maskapai;
use Illuminate\Support\Facades\Validator;
//model Pembimbing
use App\Models\Pembimbing;
//model HargaTermasuk
use App\Models\HargaTermasuk;
//model HargaTidakTermasuk
use App\Models\HargaTidakTermasuk;
//model Keunggulan
use App\Models\Keunggulan;
//model SyaratKetentuan
use App\Models\SyaratKetentuan;

use Illuminate\Support\Str;

class PaketController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */

     //constructor
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'view']]);
    }
    public function create(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'tipe_paket' => 'nullable|string',
            'nama_paket' => 'nullable|string',
            'durasi' => 'nullable|string',
            'pemberangkatan' => 'nullable|string',
            'maskapai' => 'nullable|string',
            'harga_quad' => 'nullable|integer',
            'harga_triple' => 'nullable|integer',
            'harga_double' => 'nullable|integer',
            'thumbnail' => 'nullable|string',
            'flyer' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'total_pax' => 'nullable|integer',
            'sisa_pax' => 'nullable|integer',
            'currency' => 'nullable|string',
            'hotels' => 'nullable|array',
            'itineraris' => 'nullable|array',
            'pembimbings=' => 'nullable|array',
            'harga_termasuk' => 'nullable|array',
            'harga_tidak_termasuk' => 'nullable|array',
            'keunggulans' => 'nullable|array',
            'syarat_ketentuan' => 'nullable|array',
            'rating_hotel' => 'nullable|string',
            'tanggal_keberangkatan' => 'nullable|string',
            'keterangan' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        // Buat Paket
        $paket = Paket::create([
            'tipe_paket' => $request->tipe_paket,
            'nama_paket' => $request->nama_paket,
            //slug unik, nama paket diubah menjadi slug + ddmmyyyss
            'slug' => Str::slug($request->nama_paket) . date('dmYHis'),
            'durasi' => $request->durasi,
            'pemberangkatan' => $request->pemberangkatan, 
            'maskapai' => $request->maskapai,
            'harga_quad' => $request->harga_quad,
            'harga_triple' => $request->harga_triple,
            'harga_double' => $request->harga_double,
            'thumbnail' => $request->thumbnail,
            'flyer' => $request->flyer,
            'deskripsi' => $request->deskripsi,
            'total_pax' => $request->total_pax,
            'sisa_pax' => $request->sisa_pax,
            'currency' => $request->currency,
            'rating_hotel' => $request->rating_hotel,
            'tanggal_keberangkatan' => $request->tanggal_keberangkatan,
            'keterangan' => $request->keterangan,
        ]);

        // Tambahkan data Hotel
        if ($request->has('hotels')) {
            foreach ($request->hotels as $hotel) {
                Hotel::create([
                    'paket_id' => $paket->id,
                    'nama_hotel' => $hotel['nama_hotel'],
                    'lokasi' => $hotel['lokasi'],
                    'deskripsi' => $hotel['deskripsi'] ?? null,
                    'bintang' => $hotel['bintang'] ?? null,
                    'check_in' => $hotel['check_in'] ?? null,
                    'check_out' => $hotel['check_out'] ?? null,
                    'image' => $hotel['image'] ?? null,
                ]);
            }
        }

        // Tambahkan data Itinerari
        if ($request->has('itineraris')) {
            foreach ($request->itineraris as $itinerari) {
                Itinerari::create([
                    'paket_id' => $paket->id,
                    'name' => $itinerari['name'],
                    'hari' => $itinerari['hari'] ?? null,
                    'tanggal' => $itinerari['tanggal'] ?? null,
                    'deskripsi' => $itinerari['deskripsi'] ?? null,
                ]);
            }
        }

        // Tambahkan data Maskapai
        if ($request->has('maskapais')) {
            foreach ($request->maskapais as $maskapai) {
                Maskapai::create([
                    'paket_id' => $paket->id,
                    'nama_maskapai' => $maskapai['nama_maskapai'],
                    'arrival' => $maskapai['arrival'],
                    'departure' => $maskapai['departure'],
                    'date_arrival' => $maskapai['date_arrival'],
                    'date_departure' => $maskapai['date_departure'],
                    'gate' => $maskapai['gate'] ?? null,
                    'image' => $maskapai['image'] ?? null,
                ]);
            }
        }

        // Tambahkan data Pembimbing
        if ($request->has('pembimbings')) {
            foreach ($request->pembimbings as $pembimbing) {
                Pembimbing::create([
                    'paket_id' => $paket->id,
                    'nama' => $pembimbing['nama'],
                ]);
            }
        }

        // Tambahkan data HargaTermasuk
        if ($request->has('harga_termasuks')) {
            foreach ($request->harga_termasuks as $harga_termasuk) {
                HargaTermasuk::create([
                    'paket_id' => $paket->id,
                    'keterangan' => $harga_termasuk['keterangan'],
                ]);
            }
        }

        // Tambahkan data HargaTidakTermasuk
        if ($request->has('harga_tidak_termasuks')) {
            foreach ($request->harga_tidak_termasuks as $harga_tidak_termasuk) {
                HargaTidakTermasuk::create([
                    'paket_id' => $paket->id,
                    'keterangan' => $harga_tidak_termasuk['keterangan'],
                ]);
            }
        }

        // Tambahkan data Keunggulan
        if ($request->has('keunggulans')) {
            foreach ($request->keunggulans as $keunggulan) {
                Keunggulan::create([
                    'paket_id' => $paket->id,
                    'keterangan' => $keunggulan['keterangan'],
                ]);
            }
        }

        // Tambahkan data SyaratKetentuan
        if ($request->has('syarat_ketentuans')) {
            foreach ($request->syarat_ketentuans as $syarat_ketentuan) {
                SyaratKetentuan::create([
                    'paket_id' => $paket->id,
                    'keterangan' => $syarat_ketentuan['keterangan'],
                ]);
            }
        }

        // Response JSON
        return response()->json([
            'success' => true,
            'message' => 'Paket berhasil dibuat',
            'data' => $paket->load('hotels', 'itineraris', 'maskapais', 'pembimbings', 'hargaTermasuks', 'hargaTidakTermasuks', 'keunggulans', 'syaratKetentuans'),
        ]);
    }

    //index
    public function index()
    {
        $paket = Paket::with('hotels', 'itineraris', 'maskapais', 'pembimbings')->get(); 
        return response()->json([
            'success' => true,
            'message' => 'List Semua Paket',
            'data' => $paket
        ]);
    
    }

    //show
    public function view($slug)
    {
        $paket = Paket::where('slug', $slug)->with('hotels', 'itineraris', 'maskapais', 'pembimbings', 'hargaTermasuks', 'hargaTidakTermasuks', 'keunggulans', 'syaratKetentuans')->first();
        if ($paket) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Paket',
                'data' => $paket
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Paket tidak ditemukan',
                'data' => null
            ]);
        }
    }

    public function uploadImage(Request $request)
{
    // Validasi input gambar
    $validator = Validator::make($request->all(), [
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:4048', // Maksimal 2MB
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Validasi gagal',
            'errors' => $validator->errors(),
        ], 422);
    }

    // Proses upload gambar
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $extension = $image->getClientOriginalExtension();

        // Generate nama file unik
        $filename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
        $timestamp = now()->format('dmYHis');
        $uniqueNumber = rand(100, 999); // 3 angka unik
        $uniqueFilename = $filename . '_' . $timestamp . $uniqueNumber . '.' . $extension;

        // Simpan gambar ke folder 'img_uploads'
        $path = $image->storeAs('img_uploads', $uniqueFilename, 'public');

        return response()->json([
            'success' => true,
            'message' => 'Gambar berhasil diupload',
            'image_name' => $uniqueFilename,
        ]);
    }

    return response()->json([
        'success' => false,
        'message' => 'Gambar gagal diupload',
    ], 500);
}

public function update(Request $request, $slug)
{
    // Validasi input
    $validator = Validator::make($request->all(), [
        'tipe_paket' => 'nullable|string',
        'nama_paket' => 'nullable|string',
        'durasi' => 'nullable|string',
        'pemberangkatan' => 'nullable|string',
        'maskapai' => 'nullable|string',
        'harga_quad' => 'nullable|integer',
        'harga_triple' => 'nullable|integer',
        'harga_double' => 'nullable|integer',
        'thumbnail' => 'nullable|string',
        'flyer' => 'nullable|string',
        'deskripsi' => 'nullable|string',
        'total_pax' => 'nullable|integer',
        'sisa_pax' => 'nullable|integer',
        'currency' => 'nullable|string',
        'hotels' => 'nullable|array',
        'itineraris' => 'nullable|array',
        'maskapais' => 'nullable|array',
        'pembimbings=' => 'nullable|array',
        'harga_termasuks' => 'nullable|array',
        'harga_tidak_termasuks' => 'nullable|array',
        'keunggulans' => 'nullable|array',
        'syarat_ketentuans' => 'nullable|array',
        'rating_hotel' => 'nullable|string',
        'tanggal_keberangkatan' => 'nullable|string',
        'keterangasn' => 'nullable|string',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'errors' => $validator->errors(),
        ], 422);
    }

    // Cari paket berdasarkan slug
    $paket = Paket::where('slug', $slug)->first();

    if (!$paket) {
        return response()->json([
            'success' => false,
            'message' => 'Paket tidak ditemukan',
        ], 404);
    }

    // Update data Paket
    $paket->update([
        'tipe_paket' => $request->tipe_paket ?? $paket->tipe_paket,
        'nama_paket' => $request->nama_paket ?? $paket->nama_paket,
        'durasi' => $request->durasi ?? $paket->durasi,
        'pemberangkatan' => $request->pemberangkatan ?? $paket->pemberangkatan,
        'maskapai' => $request->maskapai ?? $paket->maskapai,
        'harga_quad' => $request->harga_quad ?? $paket->harga_quad,
        'harga_triple' => $request->harga_triple ?? $paket->harga_triple,
        'harga_double' => $request->harga_double ?? $paket->harga_double,
        'thumbnail' => $request->thumbnail ?? $paket->thumbnail,
        'flyer' => $request->flyer ?? $paket->flyer,
        'deskripsi' => $request->deskripsi ?? $paket->deskripsi,
        'total_pax' => $request->total_pax ?? $paket->total_pax,
        'sisa_pax' => $request->sisa_pax ?? $paket->sisa_pax,
        'currency' => $request->currency ?? $paket->currency,
        'rating_hotel' => $request->rating_hotel ?? $paket->rating_hotel,
        'tanggal_keberangkatan' => $request->tanggal_keberangkatan ?? $paket->tanggal_keberangkatan,
        'keterangan' => $request->keterangan ?? $paket->keterangan,
    ]);

    // Update atau tambahkan data Hotel
    if ($request->has('hotels')) {
        $paket->hotels()->delete();
        foreach ($request->hotels as $hotel) {
            Hotel::create([
                'paket_id' => $paket->id,
                'nama_hotel' => $hotel['nama_hotel'],
                'lokasi' => $hotel['lokasi'],
                'deskripsi' => $hotel['deskripsi'] ?? null,
                'bintang' => $hotel['bintang'] ?? null,
                'check_in' => $hotel['check_in'] ?? null,
                'check_out' => $hotel['check_out'] ?? null,
                'image' => $hotel['image'] ?? null,
            ]);
        }
    }

    // Update atau tambahkan data Itinerari
    if ($request->has('itineraris')) {
        $paket->itineraris()->delete();
        foreach ($request->itineraris as $itinerari) {
            Itinerari::create([
                'paket_id' => $paket->id,
                'name' => $itinerari['name'],
                'hari' => $itinerari['hari'] ?? null,
                'tanggal' => $itinerari['tanggal'] ?? null,
                'deskripsi' => $itinerari['deskripsi'] ?? null,
            ]);
        }
    }

    // Update atau tambahkan data Pembimbing
    if ($request->has('pembimbings')) {
        $paket->pembimbings()->delete();
        foreach ($request->pembimbings as $pembimbing) {
            Pembimbing::create([
                'paket_id' => $paket->id,
                'nama' => $pembimbing['nama'],
            ]);
        }
    }

    // Update atau tambahkan data HargaTermasuk
    if ($request->has('harga_termasuks')) {
        $paket->hargaTermasuks()->delete();
        foreach ($request->harga_termasuks as $harga_termasuk) {
            HargaTermasuk::create([
                'paket_id' => $paket->id,
                'keterangan' => $harga_termasuk['keterangan'],
            ]);
        }
    }

    // Update atau tambahkan data HargaTidakTermasuk
    if ($request->has('harga_tidak_termasuks')) {
        $paket->hargaTidakTermasuks()->delete();
        foreach ($request->harga_tidak_termasuks as $harga_tidak_termasuk) {
            HargaTidakTermasuk::create([
                'paket_id' => $paket->id,
                'keterangan' => $harga_tidak_termasuk['keterangan'],
            ]);
        }
    }

    // Update atau tambahkan data Keunggulan
    if ($request->has('keunggulans')) {
        $paket->keungulans()->delete();
        foreach ($request->keunggulans as $keunggulan) {
            Keunggulan::create([
                'paket_id' => $paket->id,
                'keterangan' => $keunggulan['keterangan'],
            ]);
        }
    }

    // Update atau tambahkan data SyaratKetentuan
    if ($request->has('syarat_ketentuans')) {
        $paket->syaratKetentuans()->delete();
        foreach ($request->syarat_ketentuans as $syarat_ketentuan) {
            SyaratKetentuan::create([
                'paket_id' => $paket->id,
                'keterangan' => $syarat_ketentuan['keterangan'],
            ]);
        }
    }

    //update rating_hotel
    if ($request->has('rating_hotel')) {
        $paket->rating_hotel = $request->rating_hotel;
        $paket->save();
    }

    //update tanggal_keberangkatan
    if ($request->has('tanggal_keberangkatan')) {
        $paket->tanggal_keberangkatan = $request->tanggal_keberangkatan;
        $paket->save();
    }
    

    // Update atau tambahkan data Maskapai
    if ($request->has('maskapais')) {
        $paket->maskapais()->delete();
        foreach ($request->maskapais as $maskapai) {
            Maskapai::create([
                'paket_id' => $paket->id,
                'nama_maskapai' => $maskapai['nama_maskapai'],
                'arrival' => $maskapai['arrival'],
                'departure' => $maskapai['departure'],
                'date_arrival' => $maskapai['date_arrival'],
                'date_departure' => $maskapai['date_departure'],
                'gate' => $maskapai['gate'] ?? null,
                'image' => $maskapai['image'] ?? null, 
            ]);
        }
    }

    

    return response()->json([
        'success' => true,
        'message' => 'Paket berhasil diperbarui',
        'data' => $paket->load('hotels', 'itineraris', 'maskapais'),
    ]);
}

//delete
public function delete($slug)
{
    // Cari paket berdasarkan slug
    $paket = Paket::where('slug', $slug)->first();

    if (!$paket) {
        return response()->json([
            'success' => false,
            'message' => 'Paket tidak ditemukan',
        ], 404);
    }

    // Hapus data paket
    $paket->delete();

    return response()->json([
        'success' => true,
        'message' => 'Paket berhasil dihapus',
    ]);
}



}
