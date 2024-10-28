@extends('layouts.app')

@section('title', 'Agenda')
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
                            <a href="javascript:void(0)" class="btn btn-outline-danger delete-data" data-url="{{ route('post.agenda.destroy', [$agenda->id, 'uuid' => $agenda->uuid]) }}" data-token="{{ csrf_token() }}" data-label="{{ $agenda->judul }}"> Hapus </a>
                            <a href="{{ route('post.agenda.edit', [$agenda->id, 'uuid' => $agenda->uuid]) }}" class="btn btn-outline-primary">Edit</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="fw-bold">Tanggal Agenda</div>
                            <div>{{ $agenda->tanggal }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Judul</div>
                            <div>{{ $agenda->judul }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Meta Keywords</div>
                            <div>{{ $agenda->meta_keywords ?? '-' }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Meta Description</div>
                            <div>{{ $agenda->meta_description ?? '-' }}</div>
                        </div>
                        @if ($agenda->publish == 'ya')
                            <span class="badge bg-success-lt">Publish {{ $agenda->publish_at }}</span>
                            @if ($agenda->tampil_banner == 'ya')
                                <span class="badge bg-primary-lt">Ditampilkan di Banner</span>
                            @endif
                        @else
                            <span class="badge bg-secondary-lt ">Pending</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-center mb-5">
                            <img src="{{ $agenda->gambar ? asset('storage/gambar/' . $agenda->gambar) : '' }}" class="img-thumbnail rounded">
                        </div>
                        {!! $agenda->konten !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
