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
                        <div class="row justify-content-between">
                            <div class="col-md-6">
                                <a href="{{ route('informasi.create') }}" class="btn btn-primary">Tambah Data Informasi
                                    Masjid</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="{{ config('app.table_style') }}">
                                <thead>
                                    <tr>
                                        <th width="1%">No</th>
                                        <th>Informasi</th>
                                        <th>Dibuat Oleh</th>
                                        <th>Aksi</th>

                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    @foreach ($informasi as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="fw-bold">{{ $item->judul }}
                                                </div>
                                                {!! $item->konten !!}
                                            </td>
                                            <td>{{ $item->createdBy->name }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('informasi.edit', $item->id) }}"
                                                        class="btn btn-sm btn-warning me-1">
                                                        <i class="bi bi-pen-fill"></i> Edit
                                                    </a>
                                                    <a href="{{ route('informasi.show', $item->id) }}"
                                                        class="btn btn-sm btn-primary me-1">
                                                        <i class="bi bi-eye-fill"></i> Show
                                                    </a>
                                                    <form action="{{ route('informasi.destroy', $item->id) }}"
                                                        method="POST">
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
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
