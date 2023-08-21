<?php

namespace App\Http\Controllers;

use App\Models\Kas;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $user = auth()->user()->masjid;
        // dd($user);
        $query = Kas::UserMasjid();

        if ($request->filled('q')) {
            $query->where('keterangan', 'LIKE', '%' . $request->q . '%');
        }

        if ($request->filled('tanggal')) {
            $query->where('tanggal', $request->tanggal);
        }

        $kas = $query->latest()->paginate(25);
        $title = "Data Kas";
        $saldoAkhir = Kas::SaldoAkhir();
        $totalPemasukan = $kas->where('jenis', 'masuk')->sum('jumlah');
        $totalPengeluaran = $kas->where('jenis', 'keluar')->sum('jumlah');
        return view('kas.index', [
            'kas' => $kas,
            'title' => $title,
            'saldoAkhir' => $saldoAkhir,
            'totalPemasukan' => $totalPemasukan,
            'totalPengeluaran' => $totalPengeluaran,
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

        //validasi tanggal 

        $tanggalTransaksi = Carbon::parse($requestData['tanggal']);
        $tahunBulanTransaksi = $tanggalTransaksi->format('Ym');
        $tahunBulanSekarang = now()->format('Ym');

        // dd($tahunBulanTransaksi, $tahunBulanSekarang);

        if ($tahunBulanTransaksi != $tahunBulanSekarang) {
            flash("Data Kas Gagal Di Tambahkan. Transaksi Hanya Bisa Dilakukan Untuk Bulan Ini")->error();

            return back();
        }



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
    public function edit(Kas $ka)
    {
        $kas = $ka;
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
    public function update(Request $request, Kas $ka)
    {
        $requestData = $request->validate([
            'kategori' => 'nullable',
            'keterangan' => 'required',
            'tanggal' => 'required',
            'jumlah' => 'required',
        ]);

        $jumlah = str_replace('.', '', $requestData['jumlah']);
        $kas = $ka;

        $saldoAkhir = Kas::SaldoAkhir();

        if ($kas->jenis == 'masuk') {
            $saldoAkhir -= $kas->jumlah;
            $saldoAkhir = $saldoAkhir + $jumlah;
        }

        if ($kas->jenis == 'keluar') {
            $saldoAkhir += $kas->jumlah;
            $saldoAkhir = $saldoAkhir - $jumlah;
        }
        $requestData['jumlah'] = $jumlah;
        $kas->fill($requestData);
        $kas->save();
        auth()->user()->masjid->update([
            'saldo_akhir' => $saldoAkhir
        ]);
        flash("Data Berhasil Di Update")->success();
        return redirect(route('kas.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kas $ka)
    {
        $kas = $ka;
        $saldoAkhir = Kas::SaldoAkhir();

        if ($kas->jenis == 'masuk') {
            $saldoAkhir -= $kas->jumlah;
        }

        if ($kas->jenis == 'keluar') {
            $saldoAkhir += $kas->jumlah;
        }

        $kas->delete();
        auth()->user()->masjid->update([
            'saldo_akhir' => $saldoAkhir
        ]);
        flash("Data Sudah Di Simpan")->success();
        return redirect()->back();
    }
}
