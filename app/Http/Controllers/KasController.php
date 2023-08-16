<?php

namespace App\Http\Controllers;

use App\Models\Kas;
use Illuminate\Http\Request;

class KasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $user = auth()->user()->masjid;
        // dd($user);

        $kas = Kas::UserMasjid()->latest()->paginate(25);
        // $kas = Kas::latest();
        $title = "Data Kas";
        $saldoAkhir = Kas::SaldoAkhir();
        return view('kas.index', [
            'kas' => $kas,
            'title' => $title,
            'saldoAkhir' => $saldoAkhir
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kas = new Kas();
        $title = "Form Kas Masjid";
        $saldoAkhir = Kas::SaldoAkhir();
        $disable = [];
        return view('kas.create', [
            'kas' => $kas,
            'title' => $title,
            'saldoAkhir' => $saldoAkhir,
            'disable' => $disable,
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
            'jumlah' => 'required',
        ]);


        //membuang titik karena jika masih menggunakan titik
        $requestData['jumlah'] = str_replace('.', '', $requestData['jumlah']);
        // Mengambil kas terakhir berdasarkan masjid yang sedang login
        $saldoAkhir = Kas::SaldoAkhir();

        if ($requestData['jenis'] == 'masuk') {
            $saldoAkhir += $requestData['jumlah'];
        } else {
            $saldoAkhir -= $requestData['jumlah'];
        }


        if ($saldoAkhir <= -1) {
            flash('Data Kas Gagal Ditambahkan. Saldo Akhir yang dikurangi dari transaksi uang keluar tidak boleh kurang dari 0')->error();
            return back();
        }

        $kas = new Kas();
        $kas->fill($requestData);
        $kas->masjid_id = auth()->user()->masjid_id;
        $kas->created_by = auth()->user()->id;
        // $kas->saldo_akhir = $saldoAkhir;
        $kas->save();

        auth()->user()->masjid->update([
            'saldo_akhir' => $saldoAkhir
        ]);
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
    public function edit($id)
    {
        $kas = Kas::findOrFail($id);
        $title = "Form Edit Kas Masjid";
        $saldoAkhir = Kas::SaldoAkhir();
        $disable = ['disabled' => 'disabled'];
        return view('kas.create', [
            'kas' => $kas,
            'title' => $title,
            'saldoAkhir' => $saldoAkhir,
            'disable' => $disable
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->validate([
            'kategori' => 'nullable',
            'keterangan' => 'required',
        ]);

        $kas = Kas::findOrFail($id);
        $kas->fill($requestData);
        $kas->save();
        flash("Data Berhasil Di Update")->success();
        return redirect(route('kas.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kas = Kas::findOrFail($id);

        $kas->keterangan = 'Di Hapus Oleh ' . auth()->user()->name;
        $kas->save();

        $kasBaru = $kas->replicate();
        // dd($kasBaru);
        $kas->keterangan = 'Perbaikan Data Id Ke' . $kas->id;

        $saldoAkhir = Kas::SaldoAkhir();

        if ($kas->jenis == 'masuk') {
            $saldoAkhir -= $kas->jumlah;
        }

        if ($kas->jenis == 'keluar') {
            $saldoAkhir -= $kas->jumlah;
        }

        // $kasBaru->saldo_akhir = $saldoAkhir;
        $kasBaru->save();
        flash("Data Sudah Di Simpan")->success();
        return redirect()->back();
    }
}
