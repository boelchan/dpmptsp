@extends('layouts.app')

@section('title', 'tim')
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
                            <a href="javascript:void(0)" class="btn btn-outline-danger delete-data" data-url="{{ route('post.tim.destroy', [$tim->id, 'uuid' => $tim->uuid]) }}" data-token="{{ csrf_token() }}" data-label="{{ $tim->nama }}"> Hapus </a>
                            <a href="{{ route('post.tim.edit', [$tim->id, 'uuid' => $tim->uuid]) }}" class="btn btn-outline-primary">Edit</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="fw-bold">Nama</div>
                            <div>{{ $tim->nama }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Jabatan</div>
                            <div>{{ $tim->jabatan }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Meta Keywords</div>
                            <div>{{ $tim->meta_keywords ?? '-' }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Meta Description</div>
                            <div>{{ $tim->meta_description ?? '-' }}</div>
                        </div>
                        @if ($tim->publish == 'ya')
                            <span class="badge bg-success-lt">Publish {{ $tim->publish_at }}</span>
                        @else
                            <span class="badge bg-secondary-lt ">Pending</span>
                        @endif
                    </div>
                    <div class="card-body">
                            <img src="{{ $tim->gambar ? asset('storage/team/' . $tim->gambar) : '' }}" class="">
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        {!! $tim->konten !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
