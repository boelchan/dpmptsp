@extends('layouts.app')

@section('title', $title)
@section('sub-title', 'Overview')

@section('content')
    <div class="container">
        <div class="row justify-content-center row-cards">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Pemohon
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="card card-body mb-3">
                            <div class="mb-3">
                                <div class="fw-bold">Tanggal Pengaduan</div>
                                <div>{{ tanggalJam($pengaduan->created_at) }}</div>
                            </div>
                            <div class="mb-3">
                                <div class="fw-bold">Tanggal Validasi</div>
                                @if ($pengaduan->status == 'baru')
                                    @role('superadmin|operator')
                                        <button class="btn btn-primary mb-3 form-action" data-url="{{ route('pengaduan.validasi', [$pengaduan->id, 'uuid' => $pengaduan->uuid]) }}" data-token="{{ csrf_token() }}" data-label="Validasi pengaduan ini ?">Validasi Pengaduan</button>
                                    @endrole
                                @else
                                    <div>{{ tanggalJam($pengaduan->validasi_at) }}</div>
                                @endif
                            </div>
                            <div class="">
                                <div class="fw-bold">Tanggal Ditanggapi</div>
                                <div>{{ $pengaduan->tanggapan_at ? tanggalJam($pengaduan->tanggapan_at) : 'Menunggu tanggapan' }}</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Nama Pemohon</div>
                            <div>{{ $pengaduan->nama_pemohon }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">No Identitas</div>
                            <div>{{ $pengaduan->no_identitas }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Telepon</div>
                            <div>{{ $pengaduan->telepon }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Email</div>
                            <div>{{ $pengaduan->email }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Isi Pengaduan
                        </h3>
                    </div>
                    <div class="card-body">
                        <div>{!! $pengaduan->pengaduan !!}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Tanggapan Instansi
                        </h3>
                    </div>
                    <div class="card-body">
                        @if ($pengaduan->status == 'valid')
                            <x-form action="{{ route('pengaduan.tanggapan', [$pengaduan->id, 'uuid' => $pengaduan->uuid]) }}" method="post" id="form-x">
                                <textarea class="form-control" name="tanggapan" cols="30" rows="10" required></textarea>
                                <button type="submit" class="btn btn-primary w-100 mt-1 btn-send">Kirim Tanggapan</button>
                            </x-form>
                        @else
                            @if ($pengaduan->status == 'baru')
                                <div>Silahkan validasi terlebih dahulu pengaduan ini</div>
                            @else
                                <div>{!! $pengaduan->tanggapan !!}</div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
