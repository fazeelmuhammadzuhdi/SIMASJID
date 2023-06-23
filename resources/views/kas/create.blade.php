@extends('layouts.main')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{ $title }}</h3>
                    <p class="text-subtitle text-muted">
                        Silahkan Input Data Kas Masjid Yang Kamu Kelola
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('kas.index') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ $title }}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section id="basic-vertical-layouts">
            <div class="row match-height">
                <div class="col-md-6 col-lg-12 ">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <h6>Saldo Akhir Saat Ini : {{ formatRupiah($saldoAkhir, true) }}</h6>

                                {!! Form::model($kas, [
                                    'method' => isset($kas->id) ? 'PUT' : 'POST',
                                    'route' => isset($kas->id) ? ['kas.update', $data->id] : 'kas.store',
                                ]) !!}

                                {{-- <div class="form-group">
                                    <label for="first-name-vertical">Tanggal</label>
                                    {!! Form::datetimeLocal('tanggal', $kas->tanggal ?? now()->format('Y-m-d\TH:i'), [
                                        'class' => 'form-control' . ($errors->has('tanggal') ? ' is-invalid' : ''),
                                    ]) !!}
                                    <span class="text-danger">{!! $errors->first('tanggal') !!}</span>
                                </div> --}}

                                <div class="form-group mt-3">
                                    <label for="first-name-vertical">Tanggal</label>
                                    {!! Form::date('tanggal', $kas->tanggal ?? now(), [
                                        'class' => 'form-control' . ($errors->has('tanggal') ? ' is-invalid' : ''),
                                    ]) !!}
                                    <span class="text-danger">{!! $errors->first('tanggal') !!}</span>
                                </div>
                                <div class="form-group">
                                    <label for="first-name-vertical">Kategori</label>
                                    {!! Form::text('kategori', null, ['class' => 'form-control' . ($errors->has('kategori') ? ' is-invalid ' : '')]) !!}
                                    <span class="text-danger">{!! $errors->first('kategori') !!}</span>
                                </div>

                                <div class="form-group">
                                    <label for="first-name-vertical">Keterangan</label>
                                    {!! Form::textarea('keterangan', null, [
                                        'class' => 'form-control' . ($errors->has('keterangan') ? ' is-invalid' : ''),
                                        'rows' => 3,
                                    ]) !!}
                                    <span class="text-danger">{!! $errors->first('keterangan') !!}</span>
                                </div>
                                <div class="form-group">
                                    <label for="jenis">Jenis</label><br>
                                    <div class="form-check form-check-inline">
                                        {!! Form::radio('jenis', 'masuk', 1, [
                                            'class' => 'form-check-input' . ($errors->has('jenis') ? ' is-invalid' : ''),
                                        ]) !!}
                                        <label class="form-check-label" for="jenis">Pemasukkan</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        {!! Form::radio('jenis', 'keluar', null, [
                                            'class' => 'form-check-input' . ($errors->has('jenis') ? ' is-invalid' : ''),
                                        ]) !!}
                                        <label class="form-check-label" for="jenis">Pengeluaran</label>
                                    </div>
                                    <span class="text-danger">{!! $errors->first('jenis') !!}</span>
                                </div>


                                <div class="form-group">
                                    <label for="first-name-vertical">Jumlah Transaksi</label>
                                    {!! Form::number('jumlah', null, [
                                        'class' => 'form-control' . ($errors->has('jumlah') ? ' is-invalid' : ''),
                                    ]) !!}
                                    <span class="text-danger">{!! $errors->first('jumlah') !!}</span>
                                </div>
                                <div class="col-lg-12 col-md-6 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">
                                        Simpan
                                    </button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">
                                        Reset
                                    </button>
                                    <a href="{{ route('kas.index') }}" class="btn btn-secondary me-1 mb-1">Kembali</a>
                                </div>

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection
