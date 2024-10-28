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
                            Preview
                        </h3>
                        <div class="card-actions">
                            @role('superadmin')
                                <a href="javascript:void(0)" class="btn btn-outline-danger btn-sm delete-data" data-url="{{ route('instansi.destroy', [$instansi->id, 'uuid' => $instansi->uuid]) }}" data-token="{{ csrf_token() }}" data-label="{{ $instansi->judul }}"> Hapus </a>
                            @endrole()
                            <a href="{{ route('instansi.edit', [$instansi->id, 'uuid' => $instansi->uuid]) }}" class="btn btn-primary btn-sm">Edit</a>
                        </div>
                    </div>
                    <div class="card-body py-2">
                        @if ($instansi->active == 'ya')
                            <span class="badge bg-lime">Aktif</span>
                        @else
                            <span class="badge bg-secondary-lt ">Tidak Aktif</span>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="fw-bold">Nama {{ $title }}</div>
                            <div>{{ $instansi->nama }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Meta Keywords</div>
                            <div>{{ $instansi->meta_keywords ?? '-' }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Meta Description</div>
                            <div>{{ $instansi->meta_description ?? '-' }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Logo</div>
                            @if ($instansi->icon)
                                <div class="row justify-content-center">
                                    <img src="{{ $instansi->icon_url }}" class="rounded">
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-body py-2">
                        <a href="{{ route('instansi.layanan.create', [$instansi->id, 'uuid' => $instansi->uuid]) }}" class="btn btn-info full-width d-block">Tambah Layanan</a>
                        @forelse ($instansi->layanan as $layanan)
                            <li>{{ $layanan->nama }}</li>
                        @empty
                            Belum ada layanan
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        {!! $instansi->konten ?? 'Belum ada konten' !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
