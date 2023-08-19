@extends('layouts.main')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h4>{{ $title }}</h4>
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
                                {!! Form::model($kategori, [
                                    'method' => $method,
                                    'route' => $route,
                                ]) !!}
                                <div class="form-group">
                                    <label for="first-name-vertical">Nama Kategori <span class="text-danger">(misalnya :
                                            Agenda Masjid, Jadwal Dan Informasi Lainnya)</span></label>
                                    {!! Form::text('nama', null, ['class' => 'form-control']) !!}
                                    <span class="text-danger">{!! $errors->first('nama') !!}</span>
                                </div>

                                <div class="form-group">
                                    <label for="first-name-vertical">Keterangan</label>
                                    {!! Form::textarea('keterangan', null, [
                                        'class' => 'form-control' . ($errors->has('keterangan') ? ' is-invalid' : ''),
                                        'placeholder' => 'Masukkan Keterangan Kategori',
                                        'rows' => 3,
                                    ]) !!}
                                    <span class="text-danger">{!! $errors->first('keterangan') !!}</span>
                                </div>

                                <div class="col-lg-12 col-md-6 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">
                                        Simpan
                                    </button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">
                                        Reset
                                    </button>
                                    <a href="{{ route('kategori.index') }}" class="btn btn-secondary me-1 mb-1">Kembali</a>
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
