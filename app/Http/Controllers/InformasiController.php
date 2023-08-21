<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use App\Http\Requests\UpdateInformasiRequest;
use App\Models\Kategori;
use Illuminate\Http\Request;

class InformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $informasi = Informasi::UserMasjid()->latest()->paginate(25);
        $title = "Data Informasi Masjid";
        return view('informasi.index', compact('informasi', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['informasi'] = new Informasi();
        $data['route'] = 'informasi.store';
        $data['method'] = 'POST';
        $data['listKategori'] = Kategori::where('masjid_id', auth()->user()->masjid_id)->pluck('nama', 'id');
        $data['title'] = "Form Informasi Masjid";
        return view('informasi.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'kategori' => 'required',
            'judul' => 'required',
            'konten' => 'required',
        ]);

        Informasi::create($requestData);
        flash("Data Informasi Masjid Berhasil Di Simpan")->success();
        return redirect()->route('informasi.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $data['informasi'] =  Informasi::with('Rkategori')->findOrFail($id);
        // dd($data['informasi']);
        $data['title'] = "Detail Data";
        return view('informasi.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Informasi $informasi)
    {
        $data['informasi'] = $informasi;
        $data['route'] = ['informasi.update', $informasi->id];
        $data['method'] = 'PUT';
        $data['listKategori'] = Kategori::pluck('nama', 'id');
        $data['title'] = "Edit Informasi Masjid";
        return view('informasi.create', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Informasi $informasi)
    {
        $requestData = $request->validate([
            'kategori' => 'required',
            'judul' => 'required',
            'konten' => 'required',
        ]);

        $informasi->update($requestData);
        flash("Data informasi Masjid Berhasil Di Update")->success();
        return redirect()->route('informasi.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Informasi $informasi)
    {
        $informasi->delete();
        flash("Data Informasi Masjid Berhasil Dihapus");
        return redirect()->back();
    }
}
