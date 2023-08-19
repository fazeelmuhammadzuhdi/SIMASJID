@extends('layouts.main')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{ $title }} {{ auth()->user()->masjid->nama }}</h3>
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
                        {!! Form::open([
                            'url' => url()->current(),
                            'method' => 'GET',
                            'class' => 'row row-cols-lg-auto align-items-center',
                        ]) !!}
                        <div class="col-auto">
                            <a href="{{ route('kas.create') }}" class="btn btn-primary">Tambah Data Kas</a>
                        </div>
                        <div class="col-auto ms-auto">
                            <label for="inlineFormInputGroupUsername">Tanggal</label>
                            {!! Form::date('tanggal', request('tanggal'), ['class' => 'form-control']) !!}
                        </div>

                        <div class="col-auto">
                            <label for="inlineFormSelectPref">Keterangan Transaksi</label>
                            {!! Form::text('q', request('q'), [
                                'class' => 'form-control',
                                'placeholder' => 'Keterangan',
                            ]) !!}
                        </div>

                        <div class="col-auto mt-4">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="{{ config('app.table_style') }}">
                                <thead>
                                    <tr>
                                        <th width="1%">No</th>
                                        <th>Tanggal</th>
                                        <th>Created By</th>
                                        <th>Kategori</th>
                                        <th>Keterangan</th>
                                        <th>Pemasukkan</th>
                                        <th>Pengeluaran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kas as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->tanggal->translatedFormat('d F Y') }}</td>
                                            <td>{{ $item->createdBy->name }}</td>
                                            <td>{{ $item->kategori }}</td>
                                            <td>{{ $item->keterangan }}</td>
                                            <td class="text-end">
                                                {{ $item->jenis == 'masuk' ? formatRupiah($item->jumlah, true) : '-' }}
                                            </td>
                                            <td class="text-end">
                                                {{ $item->jenis == 'keluar' ? formatRupiah($item->jumlah, true) : '-' }}
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('kas.edit', $item->id) }}"
                                                        class="btn btn-sm btn-warning me-1">
                                                        <i class="bi bi-pen-fill"></i> Edit
                                                    </a>
                                                    <form action="{{ route('kas.destroy', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="bi bi-trash-fill"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5" class="text-center fw-bold">Total</td>
                                        <td class="text-end">{{ formatRupiah($totalPemasukan, true) }}</td>
                                        <td class="text-end">{{ formatRupiah($totalPengeluaran, true) }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="col-md-6">
                            <h3>Saldo Akhir : {{ formatRupiah($saldoAkhir, true) }}</h3>
                        </div>

                        {{ $kas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
