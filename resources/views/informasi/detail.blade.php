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
                        <table class="table table-bordered table-hover border-primary">
                            <tr width="15%">
                                <td class="fw-bold">Judul</td>
                                <td>{{ $informasi->judul }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Kategori</td>
                                <td>{{ $informasi->Rkategori->nama }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Konten</td>
                                <td>{!! $informasi->konten !!}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Tanggal Posting</td>
                                <td>{{ $informasi->created_at->translatedFormat('l, d F Y') }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Created By</td>
                                <td>{{ $informasi->createdBy->name }}</td>
                            </tr>
                        </table>
                        <a href="{{ route('informasi.index') }}" class="btn btn-primary">
                            <i class="bi bi-skip-backward-circle-fill"></i> Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
