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
                            Detail
                        </h3>
                        <div class="card-actions">
                            <a href="javascript:void(0)" class="btn btn-outline-danger btn-sm delete-data" data-url="{{ route('pegawai.destroy', [$pegawai->id, 'uuid' => $pegawai->uuid]) }}" data-token="{{ csrf_token() }}" data-label="{{ $pegawai->judul }}"> Hapus </a>
                            <a href="{{ route('pegawai.edit', [$pegawai->id, 'uuid' => $pegawai->uuid]) }}" class="btn btn-primary btn-sm">Edit</a>
                        </div>
                    </div>
                    <div class="card-body py-2">
                        @if ($pegawai->is_leader == 'ya')
                            <span class="badge bg-lime">Kepala Bidang</span>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="fw-bold">Nama</div>
                            <div>{{ $pegawai->nama }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Bidang</div>
                            <div>{{ $pegawai->bidang->nama }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Jabatan</div>
                            <div>{{ $pegawai->jabatan }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Foto</div>
                            @if ($pegawai->foto)
                                <div class="row justify-content-center">
                                    <img src="{{ $pegawai->foto_url }}" class="rounded">
                                </div>
                            @else
                                -
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
