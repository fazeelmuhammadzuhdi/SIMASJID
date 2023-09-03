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
                        <h4>
                            <i class="bi bi-calendar-check-fill"></i> Tahun Kurban :
                            {{ $kurban->tahun_hijriah . ' Hijriah' . ' ' . '/ ' . $kurban->tahun_masehi . ' Masehi' }}
                        </h4>
                        <h4>
                            <i class="bi bi-calendar-check-fill"></i> Tanggal Akhir Pendaftaran :
                            <b>{{ $kurban->tanggal_akhir_pendaftaran->translatedFormat('d F Y') }}</b>
                        </h4>
                        <h4>
                            <i class="bi bi-people-fill"></i> Created By :
                            <b>{{ $kurban->createdBy->name }}</b>
                        </h4>
                        <b>{!! $kurban->konten !!}</b>
                        <hr>
                        <h3>
                            Data Hewan Kurban
                        </h3>

                        @if ($kurban->kurbanHewan->count() >= 1)
                            <a href="{{ route('kurbanhewan.create', [
                                'kurban_id' => $kurban->id,
                            ]) }}"
                                class="btn btn-primary">
                                Buat Baru
                            </a>
                        @endif

                        @if ($kurban->kurbanHewan->count() == 0)
                            <div class="text-center fw-bold">
                                Belum Ada Data <a
                                    href="{{ route('kurbanhewan.create', [
                                        'kurban_id' => $kurban->id,
                                    ]) }}">
                                    Buat Baru
                                </a>
                            </div>
                        @else
                            <table class="{{ config('app.table_style') }} mt-3">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Hewan</th>
                                        <th>Iuran Perorang</th>
                                        <th>Harga Hewan</th>
                                        <th>Biaya Operasional</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kurban->kurbanHewan as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ ucwords($item->hewan) }} ({{ $item->kriteria }})</td>
                                            <td>{{ formatRupiah($item->iuran_perorang, true) }}</td>
                                            <td>{{ formatRupiah($item->harga, true) }}</td>
                                            <td>{{ formatRupiah($item->biaya_operasional, true) }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('kurbanhewan.edit', [$item->id, 'kurban_id' => $item->kurban_id]) }}"
                                                        class="btn btn-sm btn-warning me-1">
                                                        <i class="bi bi-pen-fill"></i> Edit
                                                    </a>

                                                    <form
                                                        action="{{ route('kurbanhewan.destroy', [$item->id, 'kurban_id' => $item->kurban_id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            onclick="return confirm('Apakah Yakin Ingin Mengahapus Data Ini ?')"
                                                            class="btn btn-sm btn-danger">
                                                            <i class="bi bi-trash-fill"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        @endif
                        {{-- Modul Peserta Kurba --}}
                        <hr>
                        <h3>
                            Data Peserta Kurban
                        </h3>

                        @if ($kurban->kurbanPeserta->count() >= 1)
                            <a href="{{ route('kurbanpeserta.create', [
                                'kurban_id' => $kurban->id,
                            ]) }}"
                                class="btn btn-primary">
                                Buat Baru
                            </a>
                        @endif
                        @if ($kurban->kurbanPeserta->count() == 0)
                            <div class="text-center fw-bold">
                                Belum Ada Data <a
                                    href="{{ route('kurbanpeserta.create', [
                                        'kurban_id' => $kurban->id,
                                    ]) }}">
                                    Buat Baru
                                </a>
                            </div>
                        @else
                            <table class="{{ config('app.table_style') }} mt-3">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Peserta</th>
                                        <th>Nomor Hp</th>
                                        <th>Alamat</th>
                                        <th>Hewan Kurban</th>
                                        <th>Status Pembayaran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kurban->kurbanPeserta as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->peserta->nama ?? '' }}</td>
                                            <td>{{ $item->peserta->nohp ?? '' }}</td>
                                            <td>{{ $item->peserta->alamat ?? '' }}</td>
                                            <td>
                                                {{ ucwords($item->kurbanHewan->hewan) }} -
                                                {{ formatRupiah($item->kurbanHewan->iuran_perorang, true) }}

                                            </td>
                                            <td class=" text-center">
                                                @if ($item->status_bayar == 'LUNAS')
                                                    <span class="badge bg-success">LUNAS</span>
                                                @else
                                                    <span class="badge bg-danger">BELUM LUNAS</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('kurbanpeserta.edit', [$item->id, 'kurban_id' => $item->kurban_id]) }}"
                                                        class="btn btn-sm btn-warning me-1">
                                                        <i class="bi bi-pen-fill"></i> Edit
                                                    </a>

                                                    <form
                                                        action="{{ route('kurbanpeserta.destroy', [$item->id, 'kurban_id' => $item->kurban_id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            onclick="return confirm('Apakah Yakin Ingin Mengahapus Data Ini ?')"
                                                            class="btn btn-sm btn-danger">
                                                            <i class="bi bi-trash-fill"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        @endif

                        <a href="{{ route('informasi.index') }}" class="btn btn-primary mt-3">
                            <i class="bi bi-skip-backward-circle-fill"></i> Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
