<?php

namespace App\Http\Controllers;

use App\Models\KurbanHewan;
use App\Http\Requests\StoreKurbanHewanRequest;
use App\Http\Requests\UpdateKurbanHewanRequest;
use App\Models\Kurban;

class KurbanHewanController extends Controller
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
        // dd($kurban->id);
        $data['kurbanhewan'] = new KurbanHewan();
        $data['route'] = 'kurbanhewan.store';
        $data['method'] = 'POST';
        $data['kurban'] = $kurban;
        $data['title'] = "Form Informasi Kurban Hewan Masjid";
        return view('kurbanhewan.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKurbanHewanRequest $request)
    {
        // dd($request->validated());
        KurbanHewan::create($request->validated());
        flash("Data Informasi Hewan Kurban Masjid Berhasil Di Simpan")->success();
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(KurbanHewan $kurbanhewan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KurbanHewan $kurbanhewan)
    {
        $kurban = Kurban::UserMasjid()->where('id', request('kurban_id'))->firstOrFail();
        $data['kurbanhewan'] = $kurbanhewan;
        $data['route'] = ['kurbanhewan.update', $kurbanhewan->id];
        $data['method'] = 'PUT';
        $data['kurban'] = $kurban;
        $data['title'] = "Edit Informasi Hewan Kurban Masjid";
        return view('kurbanhewan.create', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKurbanHewanRequest $request, KurbanHewan $kurbanhewan)
    {
        $kurbanhewan->update($request->validated());
        flash("Data Informasi Hewan Kurban Masjid Berhasil Di Update")->info();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KurbanHewan $kurbanhewan)
    {
        Kurban::UserMasjid()->where('id', request('kurban_id'))->firstOrFail();

        // dd($kurbanhewan->kurbanPeserta->count());

        if ($kurbanhewan->kurbanPeserta->count() == 0) {
            $kurbanhewan->delete();
            flash("Data Informasi Hewan Kurban Masjid Berhasil Di Hapus")->success();
            return back();
        }
        flash("Data Gagal Di Hapus, Karena Sudah Ada Data Pesertanya")->error();
        return back();
    }
}
