@extends('layouts.app')

@section('title', 'Post')
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
                            @if ($post->id != 1)
                                <a href="javascript:void(0)" class="btn btn-outline-danger btn-sm delete-data" data-url="{{ route('post.destroy', [$post->id, 'uuid' => $post->uuid]) }}" data-token="{{ csrf_token() }}" data-label="{{ $post->judul }}"> Hapus </a>
                            @endif
                            <a href="{{ route('post.edit', [$post->id, 'uuid' => $post->uuid]) }}" class="btn btn-primary btn-sm">Edit</a>
                        </div>
                    </div>
                    <div class="card-body py-2">
                        @if ($post->publish == 'ya')
                            <span class="badge bg-lime">Publish {{ tanggalJam($post->publish_at) }}</span>
                            @if ($post->tampil_banner == 'ya')
                                <span class="badge bg-info mt-1">Tampil di Banner</span>
                            @endif
                        @else
                            <span class="badge bg-secondary ">Pending</span>
                        @endif
                        @if ($post->add_to_submenu == 'ya')
                            <span class="badge bg-purple mt-1">Tampil di Submenu</span>
                        @endif
                        @if ($post->set_welcome_message == 'ya')
                            <span class="badge bg-yellow mt-1"> Tampil di awal buka website </span>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="fw-bold">Instansi</div>
                            <div>{{ $post->instansi_id ? $post->instansi->nama : 'MPP' }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Kategori</div>
                            <div>{{ $post->kategori->nama }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Judul</div>
                            <div>{{ $post->judul }}</div>
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
                                    <div>{{ $post->meta_keywords ?? '-' }}</div>
                                </div>
                                <div class="">
                                    <div class="fw-bold">Meta Description</div>
                                    <div>{{ $post->meta_description ?? '-' }}</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @if ($post->gambar)
                            <div class="row justify-content-center mb-5">
                                <img src="{{ $post->gambar_url }}" class="rounded">
                            </div>
                        @endif
                        {!! $post->konten !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
