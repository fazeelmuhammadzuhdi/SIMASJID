@extends('layouts.main')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h4>{{ $title }} {{ auth()->user()->masjid->nama }}</h4>
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

                    <div class="card-body">
                        <table class="table table-light">
                            <tr>
                                <td class="fw-bold">Judul</td>
                                <td>{{ $profil->judul }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Konten</td>
                                <td>{!! $profil->konten !!}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Tanggal Posting</td>
                                <td>{{ $profil->created_at->translatedFormat('l, d F Y') }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Created By</td>
                                <td>{{ $profil->createdBy->name }}</td>
                            </tr>
                        </table>
                        <a href="{{ route('profil.index') }}" class="btn btn-primary">
                            Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
