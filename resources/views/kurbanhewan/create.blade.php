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
                                {!! Form::model($kurbanhewan, [
                                    'method' => $method,
                                    'route' => $route,
                                ]) !!}
                                {!! Form::hidden('kurban_id', $kurban->id, []) !!}
                                <div class="form-group">
                                    <label for="first-name-vertical">Hewan</label>
                                    {!! Form::select(
                                        'hewan',
                                        [
                                            'sapi' => 'Sapi',
                                            'domba' => 'Domba',
                                            'kambing' => 'Kambing',
                                            'kerbau' => 'Kerbau',
                                            'onta' => 'Onta',
                                        ],
                                        null,
                                        ['class' => 'form-control'],
                                    ) !!}
                                    <span class="text-danger">{!! $errors->first('hewan') !!}</span>
                                </div>

                                <div class="form-group">
                                    <label for="first-name-vertical">Kriteria</label>
                                    {!! Form::text('kriteria', $kurbanhewan->kriteria ?? 'Standar', ['class' => 'form-control']) !!}
                                    <span class="text-danger">{!! $errors->first('kriteria') !!}</span>
                                </div>

                                <div class="form-group">
                                    <label for="first-name-vertical">Iuran Per orang</label>
                                    {!! Form::text('iuran_perorang', null, ['class' => 'form-control rupiah']) !!}
                                    <span class="text-danger">{!! $errors->first('iuran_perorang') !!}</span>
                                </div>

                                <div class="form-group">
                                    <label for="first-name-vertical">Harga Hewan</label>
                                    {!! Form::text('harga', null, ['class' => 'form-control rupiah']) !!}
                                    <span class="text-danger">{!! $errors->first('harga') !!}</span>
                                </div>

                                <div class="form-group">
                                    <label for="first-name-vertical">Biaya Operasional</label>
                                    {!! Form::text('biaya_operasional', null, ['class' => 'form-control rupiah']) !!}
                                    <span class="text-danger">{!! $errors->first('biaya_operasional') !!}</span>
                                </div>


                                <div class="col-lg-12 col-md-6 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">
                                        Simpan
                                    </button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">
                                        Reset
                                    </button>
                                    <a href="{{ route('kurban.show', $kurban->id) }}"
                                        class="btn btn-secondary me-1 mb-1">Kembali</a>
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
