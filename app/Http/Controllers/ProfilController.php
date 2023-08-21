<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profil = Profil::UserMasjid()->latest()->paginate(25);
        $title = "Data Profil Masjid";
        return view('profile.profil_masjid', compact('profil', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['profil'] = new Profil();
        $data['route'] = 'profil.store';
        $data['method'] = 'POST';
        $data['listKategori'] = [
            'visi-misi' => 'Visi Misi',
            'sejarah' => 'Sejarah',
            'struktur-organisasi' => 'Struktur Organisasi',
        ];
        $data['title'] = "Form Profil Masjid";
        return view('profile.create_profil_masjid', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $requestData = $request->validate([
            'kategori' => 'required',
            'judul' => 'required',
            'konten' => 'required',
        ]);

        Profil::create($requestData);
        flash("Data Profil Masjid Berhasil Di Simpan")->success();
        return redirect()->route('profil.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Profil $profil)
    {
        $data['profil'] = $profil;
        $data['title'] = "Detail Data";
        return view('profile.show_profil_masjid', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profil $profil)
    {
        $data['profil'] = $profil;
        $data['route'] = ['profil.update', $profil->id];
        $data['method'] = 'PUT';
        $data['listKategori'] = [
            'visi-misi' => 'Visi Misi',
            'sejarah' => 'Sejarah',
            'struktur-organisasi' => 'Struktur Organisasi',
        ];
        $data['title'] = "Edit Profil Masjid";
        return view('profile.edit_profil_masjid', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profil $profil)
    {
        $requestData = $request->validate([
            'kategori' => 'required',
            'judul' => 'required',
            'konten' => 'required',
        ]);

        $profil->update($requestData);
        flash("Data Profil Masjid Berhasil Di Update")->success();
        return redirect()->route('profil.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profil $profil)
    {
        $profil->delete();
        flash("Data Profil Masjid Berhasil Dihapus");
        return redirect()->back();
    }
}
