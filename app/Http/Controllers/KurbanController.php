<?php

namespace App\Http\Controllers;

use App\Models\Kurban;
use Illuminate\Http\Request;

class KurbanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kurban = Kurban::UserMasjid()->latest()->paginate(25);
        $title = "Data Informasi Kurban";

        return view('kurban.index', compact('kurban', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['kurban'] = new Kurban();
        $data['route'] = 'kurban.store';
        $data['method'] = 'POST';
        $data['title'] = "Form Informasi Kurban Masjid";
        return view('kurban.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'tahun_hijriah' => 'required',
            'tahun_masehi' => 'required',
            'tanggal_akhir_pendaftaran' => 'required',
            'konten' => 'required',
        ]);

        Kurban::create($requestData);
        flash("Data Informasi Kurban Masjid Berhasil Di Simpan")->success();
        return redirect()->route('kurban.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kurban $kurban)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kurban $kurban)
    {
        // dd($kurban);
        $data['kurban'] = $kurban;
        $data['route'] = ['kurban.update', $kurban->id];
        $data['method'] = 'PUT';
        $data['title'] = "Edit Informasi Kurban Masjid";
        return view('kurban.create', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kurban $kurban)
    {
        $requestData = $request->validate([
            'tahun_hijriah' => 'required',
            'tahun_masehi' => 'required',
            'tanggal_akhir_pendaftaran' => 'required',
            'konten' => 'required',
        ]);

        $kurban->update($requestData);
        flash("Data informasi Kurban Masjid Berhasil Di Update")->success();
        return redirect()->route('kurban.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kurban $kurban)
    {
        $kurban->delete();
        flash("Data Informasi Kurban Masjid Berhasil Dihapus");
        return redirect()->back();
    }
}
