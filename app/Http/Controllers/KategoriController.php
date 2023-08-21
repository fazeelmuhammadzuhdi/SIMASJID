<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::UserMasjid()->latest()->paginate(25);
        $title = "Data Kategori Informasi";
        return view('kategori.index', compact('kategori', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['kategori'] = new Kategori();
        $data['route'] = 'kategori.store';
        $data['method'] = 'POST';
        $data['title'] = "Form Tambah Kategori Informasi Masjid";
        return view('kategori.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'nama' => 'required',
            'keterangan' => 'nullable',
        ]);

        $requestData['parent_id'] = 0;
        Kategori::create($requestData);
        flash("Data Kategori Informasi Berhasil Di Simpan")->success();
        return redirect()->route('kategori.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        $data['kategori'] = $kategori;
        $data['route'] = ['kategori.update', $kategori->id];
        $data['method'] = 'PUT';
        $data['title'] = "Edit Kategori Informasi Masjid";
        return view('kategori.create', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $requestData = $request->validate([
            'nama' => 'required',
            'keterangan' => 'nullable',
        ]);

        $kategori->update($requestData);
        flash("Data Kategori Informasi Masjid Berhasil Di Update")->success();
        return redirect()->route('kategori.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        flash("Data Kategori Informasi Masjid Berhasil Dihapus");
        return back();
    }
}
