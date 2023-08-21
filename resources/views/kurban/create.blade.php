@extends('layouts.main')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{ $title }}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('profil.index') }}">Dashboard</a>
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
                                {!! Form::model($kurban, [
                                    'method' => $method,
                                    'route' => $route,
                                ]) !!}

                                <div class="form-group">
                                    <label for="first-name-vertical">Tahun Hijriah</label>
                                    {!! Form::selectRange('tahun_hijriah', 1445, 1460, null, [
                                        'class' => 'form-control',
                                    ]) !!}
                                    <span class="text-danger">{!! $errors->first('tahun_hijriah') !!}</span>
                                </div>

                                <div class="form-group">
                                    <label for="first-name-vertical">Tahun Masehi</label>
                                    {!! Form::selectRange('tahun_masehi', 2023, date('Y'), null, [
                                        'class' => 'form-control',
                                    ]) !!}
                                    <span class="text-danger">{!! $errors->first('tahun_masehi') !!}</span>
                                </div>

                                <div class="form-group">
                                    <label for="first-name-vertical">Tanggal Akhir Pendaftaran</label>
                                    {!! Form::date('tanggal_akhir_pendaftaran', now(), ['class' => 'form-control']) !!}
                                    <span class="text-danger">{!! $errors->first('tanggal_akhir_pendaftaran') !!}</span>
                                </div>

                                <div class="form-group">
                                    <label for="first-name-vertical">Konten / Informasi Kurban</label>
                                    {!! Form::textarea('konten', null, [
                                        'class' => 'form-control' . ($errors->has('konten') ? ' is-invalid' : ''),
                                        'id' => 'summernote',
                                    ]) !!}
                                    <span class="text-danger">{!! $errors->first('konten') !!}</span>
                                </div>

                                <div class="col-lg-12 col-md-6 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">
                                        Simpan
                                    </button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">
                                        Reset
                                    </button>
                                    <a href="{{ route('kurban.index') }}" class="btn btn-secondary me-1 mb-1">Kembali</a>
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
