@extends('layouts.app')

@section('title', $title)
@section('sub-title', 'Detail')

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
                            <a href="javascript:void(0)" class="btn btn-outline-danger btn-sm delete-data" data-url="{{ route('document.destroy', [$document->id, 'uuid' => $document->uuid]) }}" data-token="{{ csrf_token() }}" data-label="{{ $document->judul }}"> Hapus </a>
                            <a href="{{ route('document.edit', [$document->id, 'uuid' => $document->uuid]) }}" class="btn btn-primary btn-sm">Edit</a>
                        </div>
                    </div>
                    <div class="card-body py-2">
                        @if ($document->publish == 'ya')
                            <span class="badge bg-lime">Publish</span>
                        @else
                            <span class="badge bg-secondary">Pending</span>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="fw-bold">Kategori</div>
                            <div>{{ $document->kategori->nama }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Nama {{ $title }}</div>
                            <div>{{ $document->title }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Berkas</div>
                            @if ($document->file)
                                <div class="row justify-content-center">
                                    <a href="{{ $document->url_berkas }}" target="_blank">Lihat <i class="ti ti-external-link"></i></a>
                                </div>
                            @else
                                -
                            @endif
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    META DATA
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="fw-bold">Meta Keywords</div>
                                    <div>{{ $document->meta_keywords ?? '-' }}</div>
                                </div>
                                <div class="">
                                    <div class="fw-bold">Meta Description</div>
                                    <div>{{ $document->meta_description ?? '-' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        {!! $document->konten ?? 'Belum ada konten' !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
