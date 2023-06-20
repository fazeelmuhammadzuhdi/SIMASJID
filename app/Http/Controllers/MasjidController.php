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
        $masjid = auth()->user()->masjid;
        // dd($masjid);
        //jika user masjid masih kosong maka buat datanya dan update usernya sekaligus
        $masjid = $masjid ?? new Masjid();

        return view('masjid.create', [
            'masjid' => $masjid
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

        $masjid = auth()->user()->masjid;
        // dd($masjid);
        //jika user masjid masih kosong maka buat datanya dan update usernya sekaligus
        $masjid = $masjid ?? new Masjid();
        $masjid->nama = $data['nama'];
        $masjid->alamat = $data['alamat'];
        $masjid->telp = $data['telp'];
        $masjid->email = $data['email'];
        $masjid->save();

        $user = auth()->user();
        // dd($user);
        $user->masjid_id = $masjid->id;
        $user->save();
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
