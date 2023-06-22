@extends('layouts.main')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{ $title }}</h3>
                    <p class="text-subtitle text-muted">
                        Silahkan Update User Profile Anda
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.html">Dashboard</a>
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
                                {!! Form::model(auth()->user(), [
                                    'method' => 'PUT',
                                    'route' => ['userprofile.update', 0],
                                ]) !!}

                                <div class="form-group">
                                    <label for="first-name-vertical">Nama</label>
                                    {!! Form::text('name', null, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : '')]) !!}
                                    <span class="text-danger">{!! $errors->first('name') !!}</span>
                                </div>
                                <div class="form-group">
                                    <label for="first-name-vertical">Email</label>
                                    {!! Form::email('email', null, ['class' => 'form-control' . ($errors->has('alamat') ? ' is-invalid ' : '')]) !!}
                                    <span class="text-danger">{!! $errors->first('email') !!}</span>
                                </div>

                                <div class="form-group">
                                    <label for="first-name-vertical">Password</label>
                                    {!! Form::password('password', ['class' => 'form-control' . ($errors->has('password') ? ' is-invalid ' : '')]) !!}
                                    <span class="text-danger">{!! $errors->first('password') !!}</span>
                                </div>
                                <div class="col-lg-12 col-md-6 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">
                                        Simpan
                                    </button>

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
