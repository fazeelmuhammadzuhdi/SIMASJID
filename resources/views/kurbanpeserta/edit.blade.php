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
                                {!! Form::model($kurbanpeserta, [
                                    'method' => $method,
                                    'route' => $route,
                                ]) !!}
                                {!! Form::hidden('kurban_id', $kurban->id, []) !!}
                                <h4>Status Pembayaran {{ $kurbanpeserta->peserta->nama }} :
                                    {{ $kurbanpeserta->getStatusTeks() }}</h4>

                                <h6>Informasi Iuran Perorang :
                                    {{ formatRupiah($kurbanpeserta->kurbanHewan->iuran_perorang, true) }}</h6>
                                <div class="form-group">
                                    <label for="first-name-vertical">Hewan Kurban</label>
                                    {!! Form::select('kurban_hewan_id', $listKurbanHewan, null, ['class' => 'form-control']) !!}
                                    <span class="text-danger">{!! $errors->first('kurban_hewan_id') !!}</span>
                                </div>


                                <div class="form-group">
                                    <label for="first-name-vertical">Total Pembayaran</label>
                                    {!! Form::text('total_bayar', null, ['class' => 'form-control rupiah']) !!}
                                    <span class="text-danger">{!! $errors->first('total_bayar') !!}</span>
                                </div>

                                <div class="form-group">
                                    <label for="first-name-vertical">Tanggal Pembayaran</label>
                                    {!! Form::text('tanggal_bayar', $kurbanpeserta->tanggal_bayar ?? now(), ['class' => 'form-control']) !!}
                                    <span class="text-danger">{!! $errors->first('tanggal_bayar') !!}</span>
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

@push('after-script')
    <script>
        $(document).ready(function() {
            $('.pembayaran').hide();
            $('#my-input').change(function(e) {
                if ($(this).is(':checked')) {
                    $('.pembayaran').show();
                } else {
                    $('.pembayaran').hide();
                }
            });
        });
    </script>
@endpush
