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
                            <a href="javascript:void(0)" class="btn btn-outline-danger btn-sm delete-data" data-url="{{ route('link.destroy', [$link->id, 'uuid' => $link->uuid]) }}" data-token="{{ csrf_token() }}" data-label="{{ $link->judul }}"> Hapus </a>
                            <a href="{{ route('link.edit', [$link->id, 'uuid' => $link->uuid]) }}" class="btn btn-primary btn-sm">Edit</a>
                        </div>
                    </div>
                    <div class="card-body py-2">
                        @if ($link->publish == 'ya')
                            <span class="badge bg-lime">Publish</span>
                        @else
                            <span class="badge bg-secondary-lt ">Pending</span>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="fw-bold">Nama {{ $title }}</div>
                            <div>{{ $link->nama }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Alamat Url / Link</div>
                            <div><a href="https://{{ $link->url }}" target="_blank">https://{{ $link->url }} <i class="ti ti-external-link"></i></a></div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Icon</div>
                            @if ($link->icon)
                                <div class="row justify-content-center">
                                    <img src="{{ $link->icon_url }}" class="rounded">
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
                                    <div>{{ $link->meta_keywords ?? '-' }}</div>
                                </div>
                                <div class="">
                                    <div class="fw-bold">Meta Description</div>
                                    <div>{{ $link->meta_description ?? '-' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
