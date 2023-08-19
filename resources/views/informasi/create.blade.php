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
                                {!! Form::model($informasi, [
                                    'method' => $method,
                                    'route' => $route,
                                ]) !!}
                                <div class="form-group">
                                    <label for="first-name-vertical">Kategori</label>
                                    {!! Form::select('kategori', $listKategori, null, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Pilih Kategori Informasi',
                                    ]) !!}
                                    <span class="text-danger">{!! $errors->first('kategori') !!}</span>
                                </div>

                                <div class="form-group">
                                    <label for="first-name-vertical">Judul</label>
                                    {!! Form::text('judul', null, ['class' => 'form-control']) !!}
                                    <span class="text-danger">{!! $errors->first('judul') !!}</span>
                                </div>

                                <div class="form-group">
                                    <label for="first-name-vertical">Konten / Isi</label>
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
                                    <a href="{{ route('informasi.index') }}" class="btn btn-secondary me-1 mb-1">Kembali</a>
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
