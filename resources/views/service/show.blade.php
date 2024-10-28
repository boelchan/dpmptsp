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
                            <a href="javascript:void(0)" class="btn btn-outline-danger btn-sm delete-data" data-url="{{ route('service.destroy', [$service->id, 'uuid' => $service->uuid]) }}" data-token="{{ csrf_token() }}" data-label="{{ $service->judul }}"> Hapus </a>
                            <a href="{{ route('service.edit', [$service->id, 'uuid' => $service->uuid]) }}" class="btn btn-primary btn-sm">Edit</a>
                        </div>
                    </div>
                    <div class="card-body py-2">
                        @if ($service->publish == 'ya')
                            <span class="badge bg-lime">Publish</span>
                        @else
                            <span class="badge bg-secondary-lt ">Pending</span>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="fw-bold">Nama {{ $title }}</div>
                            <div>{{ $service->nama }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Icon</div>
                            @if ($service->icon)
                                <div class="row justify-content-center">
                                    <img src="{{ $service->icon_url }}" class="rounded">
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
                                    <div>{{ $service->meta_keywords ?? '-' }}</div>
                                </div>
                                <div class="">
                                    <div class="fw-bold">Meta Description</div>
                                    <div>{{ $service->meta_description ?? '-' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        {!! $service->konten ?? 'Belum ada konten' !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
