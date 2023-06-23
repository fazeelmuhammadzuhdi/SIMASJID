<?php

namespace App\Http\Controllers;

use App\Models\Kas;
use App\Http\Requests\StoreKasRequest;
use App\Http\Requests\UpdateKasRequest;
use Illuminate\Http\Request;

class KasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kas = Kas::latest()->paginate(25);
        // $kas = Kas::latest();
        $title = "Data Kas";
        return view('kas.index', [
            'kas' => $kas,
            'title' => $title
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kas = new Kas();
        $title = "Form Kas Masjid";
        return view('kas.create', [
            'kas' => $kas,
            'title' => $title,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'tanggal' => 'required|date',
            'kategori' => 'nullable',
            'keterangan' => 'required',
            'jenis' => 'required|in:masuk,keluar',
            'jumlah' => 'required|numeric',
        ]);

        // Mengambil kas terakhir berdasarkan masjid yang sedang login
        $kas = Kas::where('masjid_id', auth()->user()->masjid_id)
            ->orderBy('created_at', 'desc')
            ->first();

        $saldoAkhir = 0;
        if ($kas != null) {
            if ($requestData['jenis'] == 'masuk') {
                $saldoAkhir = $kas->saldo_akhir + $requestData['jumlah'];
            } else {
                $saldoAkhir = $kas->saldo_akhir - $requestData['jumlah'];
            }
        } else {
            $saldoAkhir = $requestData['jumlah'];
        }

        if ($saldoAkhir <= -1) {
            flash('Data Kas Gagal Ditambahkan. Saldo Akhir yang dikurangi dari transaksi uang keluar tidak boleh kurang dari 0')->error();
            return back();
        }

        $kas = new Kas();
        $kas->fill($requestData);
        $kas->masjid_id = auth()->user()->masjid_id;
        $kas->created_by = auth()->user()->id;
        $kas->saldo_akhir = $saldoAkhir;
        $kas->save();
        flash('Data Kas Masjid Berhasil Ditambahkan')->success();
        return redirect()->route('kas.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(Kas $kas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kas $kas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKasRequest $request, Kas $kas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kas $kas)
    {
        //
    }
}
