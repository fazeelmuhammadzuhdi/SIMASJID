@extends('layouts.main')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{ $title }} {{ auth()->user()->masjid->nama }}</h3>
                    {{-- <h3>{{ $title }} {{ $kas->first()->masjid->nama }}</h3> --}}
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ $title }}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row justify-content-between">
                            <div class="col-md-6">
                                <h3>Saldo Akhir : {{ formatRupiah($saldoAkhir, true) }}</h3>
                            </div>

                            <div class="col-md-6 text-end">
                                <a href="{{ route('kas.create') }}" class="btn btn-primary">Tambah Data Kas</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th width="1%">No</th>
                                    <th>Tanggal</th>
                                    <th>Kategori</th>
                                    {{-- <th>Keterangan</th> --}}
                                    <th>Pemasukkan</th>
                                    <th>Pengeluaran</th>
                                    <th>Saldo Akhir</th>
                                    <th>Di Input Oleh</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kas as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->tanggal->translatedFormat('d F Y') }}</td>
                                        {{-- <td>{{ $item->kategori ?? 'Umum' }}</td> --}}
                                        <td>{{ $item->keterangan }}</td>
                                        <td>{{ $item->jenis == 'masuk' ? formatRupiah($item->jumlah, true) : '-' }}</td>
                                        <td>{{ $item->jenis == 'keluar' ? formatRupiah($item->jumlah, true) : '-' }}</td>
                                        <td>{{ formatRupiah($item->saldo_akhir, true) }}</td>
                                        <td>{{ $item->createdBy->name }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('kas.edit', $item->id) }}"
                                                    class="btn btn-sm btn-warning me-1">
                                                    Edit
                                                </a>
                                                <form action="{{ route('kas.destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $kas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
