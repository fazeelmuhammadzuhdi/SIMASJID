<?php

namespace App\Http\Controllers;

use App\Models\Masjid;
use Illuminate\Http\Request;

class MasjidController extends Controller
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
        // $user = auth()->user()->masjid; kodingan ini sama dengan kodingan dibawah ini
        // $masjid = Masjid::where('id', auth()->user()->masjid_id)->first();

        $masjid = auth()->user()->masjid;
        // dd($masjid);
        //jika user masjid masih kosong maka buat datanya dan update usernya sekaligus
        $masjid = $masjid ?? new Masjid();
        $title = "Form Masjid";

        return view('masjid.create', [
            'masjid' => $masjid,
            'title' => $title
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'telp' => 'required',
            'email' => 'required',
        ]);

        //mengambil data masjid yang sedang login
        $masjid = auth()->user()->masjid;
        // dd($masjid);
        //jika user masjid masih kosong maka buat datanya dan update usernya sekaligus
        $masjid = $masjid ?? new Masjid();
        $masjid->nama = $data['nama'];
        $masjid->alamat = $data['alamat'];
        $masjid->telp = $data['telp'];
        $masjid->email = $data['email'];
        $masjid->save();

        //mengambil objek model user atau mengambil user yang sedang login
        $user = auth()->user();
        // dd($user);
        $user->masjid_id = $masjid->id;
        $user->save();
        flash('Data Berhasil Disimpan')->success();
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Masjid $masjid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Masjid $masjid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Masjid $masjid)
    {
        //
    }
}
