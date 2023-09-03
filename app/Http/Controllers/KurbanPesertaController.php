<?php

namespace App\Http\Controllers;

use App\Models\KurbanPeserta;
use App\Http\Requests\StoreKurbanPesertaRequest;
use App\Http\Requests\StorePesertaRequest;
use App\Http\Requests\UpdateKurbanPesertaRequest;
use App\Models\Kurban;
use App\Models\KurbanHewan;
use App\Models\Peserta;
use DB;

class KurbanPesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kurban = Kurban::UserMasjid()->where('id', request('kurban_id'))->firstOrFail();
        $data['listKurbanHewan'] = $kurban->kurbanHewan->pluck('nama_full', 'id');
        // dd($data['listKurbanHewan']);
        $data['kurbanpeserta'] = new KurbanPeserta();
        $data['route'] = 'kurbanpeserta.store';
        $data['method'] = 'POST';
        $data['kurban'] = $kurban;
        $data['title'] = "Form Informasi Peserta Kurban Masjid";
        return view('kurbanpeserta.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKurbanPesertaRequest $requestKurbanPeserta, StorePesertaRequest $requestPeserta)
    {
        $requestDataPeserta = $requestPeserta->validated();
        DB::beginTransaction();
        $peserta = Peserta::create($requestDataPeserta);

        $statusBayar = 'BELUM LUNAS';
        if ($requestKurbanPeserta->filled('status_bayar')) {
            $statusBayar = 'LUNAS';
        }
        $requestKurbanPeserta = $requestKurbanPeserta->validated();
        $kurbanHewan = KurbanHewan::UserMasjid()->where('id', $requestKurbanPeserta['kurban_hewan_id'])->firstOrFail();

        $totalBayar = $requestKurbanPeserta['total_bayar'] ?? $kurbanHewan->iuran_perorang;

        $dataKurbanPeserta = [
            'kurban_id' => $kurbanHewan->kurban_id,
            'kurban_hewan_id' => $kurbanHewan->id,
            'peserta_id' => $peserta->id,
            'total_bayar' => $totalBayar,
            'tanggal_bayar' => $requestKurbanPeserta['tanggal_bayar'],
            'metode_bayar' => "TUNAI",
            'bukti_bayar' => "OK",
            'status_bayar' => $statusBayar,
        ];
        KurbanPeserta::create($dataKurbanPeserta);
        DB::commit();
        // dd($data);   
        flash("Data Informasi Peserta Kurban Masjid Berhasil Di Simpan")->success();
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(KurbanPeserta $kurbanPeserta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KurbanPeserta $kurbanPeserta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKurbanPesertaRequest $request, KurbanPeserta $kurbanPeserta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KurbanPeserta $kurbanpesertum)
    {

        if ($kurbanpesertum->status_bayar == 'LUNAS') {
            flash("Data Peserta Kurban Tidak Bisa Di Hapus Karena Pembayaran Sudah Lunas")->error();
            return back();
        }
        $kurbanpesertum->delete();
        flash("Data Informasi Peserta Kurban Masjid Berhasil Di Hapus")->success();
        return back();
        // dd($kurbanpesertum);
    }
}
