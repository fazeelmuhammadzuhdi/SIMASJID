@extends('layouts.main')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Form Masjid</h3>
                    <p class="text-subtitle text-muted">
                        Silahkan Isi Data Masjid Yang Kamu Kelola
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.html">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Form Masjid
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
                                {!! Form::model($masjid, [
                                    'method' => 'POST',
                                    'route' => 'masjid.store',
                                ]) !!}

                                <div class="form-group">
                                    <label for="first-name-vertical">Nama Masjid</label>
                                    {!! Form::text('nama', null, ['class' => 'form-control' . ($errors->has('nama') ? ' is-invalid' : '')]) !!}
                                    <span class="text-danger">{!! $errors->first('nama') !!}</span>
                                </div>
                                <div class="form-group">
                                    <label for="first-name-vertical">Alamat Masjid</label>
                                    {!! Form::text('alamat', null, ['class' => 'form-control' . ($errors->has('alamat') ? ' is-invalid ' : '')]) !!}
                                    <span class="text-danger">{!! $errors->first('alamat') !!}</span>
                                </div>

                                <div class="form-group">
                                    <label for="first-name-vertical">No Telp / Nomor Hp Pengurus</label>
                                    {!! Form::text('telp', null, ['class' => 'form-control' . ($errors->has('telp') ? ' is-invalid ' : '')]) !!}
                                    <span class="text-danger">{!! $errors->first('telp') !!}</span>
                                </div>
                                <div class="form-group">
                                    <label for="first-name-vertical">Email Masjid</label>
                                    {!! Form::text('email', null, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid ' : '')]) !!}
                                    <span class="text-danger">{!! $errors->first('email') !!}</span>
                                </div>

                                <div class="col-lg-12 col-md-6 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">
                                        Simpan
                                    </button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">
                                        Reset
                                    </button>
                                </div>

                                {!! Form::close() !!}

                                {{-- <form class="form form-vertical" method="POST" action="{{ route('masjid.store') }}">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="first-name-vertical">Nama</label>
                                                    <input type="text" id="first-name-vertical"
                                                        class="form-control @error('nama') is-invalid @enderror"
                                                        name="nama" placeholder="First Name"
                                                        value="{{ $masjid->nama ?? '' }}">

                                                    @error('nama')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="email-id-vertical">Alamat</label>
                                                    <input type="email" id="email-id-vertical" class="form-control"
                                                        name="alamat" placeholder="Email">
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="email-id-vertical">Notelp</label>
                                                    <input type="email" id="email-id-vertical" class="form-control"
                                                        name="telp" placeholder="Email">
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="email-id-vertical">Email</label>
                                                    <input type="email" id="email-id-vertical" class="form-control"
                                                        name="email" placeholder="Email">
                                                </div>
                                            </div>




                                            <div class="col-lg-12 col-md-6 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">
                                                    Submit
                                                </button>
                                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">
                                                    Reset
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form> --}}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection
