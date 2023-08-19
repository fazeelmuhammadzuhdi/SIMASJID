@extends('layouts.main')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h4 style="font-size: 21px">{{ $title }} {{ auth()->user()->masjid->nama }}</h4>
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
                                <a href="{{ route('kategori.create') }}" class="btn btn-primary">Tambah Data Kategori
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
                                        <th>Nama Kategori</th>
                                        <th>Keterangan</th>
                                        <th>Dibuat Oleh</th>
                                        <th>Aksi</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kategori as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->keterangan ?? '-' }}</td>
                                            <td>{{ $item->createdBy->name }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('kategori.edit', $item->id) }}"
                                                        class="btn btn-sm btn-warning me-1">
                                                        <i class="bi bi-pen-fill"></i> Edit
                                                    </a>
                                                    <form action="{{ route('kategori.destroy', $item->id) }}"
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
