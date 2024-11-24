@extends('layouts.app')

@section('title', 'Post')
@section('sub-title', 'Edit')

@section('page-style')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/summernote/summernote-lite.min.css') }}" />
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit</h3>
                    </div>
                    <div class="card-body">
                        <x-form :action="route('post.update', [$post->id, 'uuid' => $post->uuid])" method="PATCH" enctype="multipart/form-data">
                            <div class="row">
                                @bind($post)
                                    <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <label for="" class="fw-bold d-block">Gambar</label>
                                            <img id="output" src="{{ $post->gambar_url }}" class="img-fluid rounded">
                                            <x-form-input name="gambar" id="gambar" type="file" accept="image/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])" />
                                        </div>
                                        <x-form-select name="kategori_id" label="Kategori <required>" :options="$kategoriOption" class="mb-2" />
                                        <x-form-textarea name="judul" label="Judul <required>" class="mb-2 h-auto" rows="3" />

                                        <div x-data="{ open: {{ $post->publish == 'ya' ? 'true' : 'false' }} }" class=" bg-secondary-lt card-body my-2">
                                            <x-form-group name="publish" label="Publish <required>" inline class="mb-2">
                                                <x-form-radio name="publish" value="ya" label="Ya" checked x-on:click="open = ! open" />
                                                <x-form-radio name="publish" value="pending" label="Pending" x-on:click="open = ! open" />
                                            </x-form-group>

                                            <div x-show="open">
                                                <x-form-input name="publish_at" label="Tanggal Publish <required>" type="datetime-local" class="mb-2" />
                                                @role('superadmin|operator')
                                                    <x-form-group name="tampil_banner" label="Tampilkan di Banner" inline>
                                                        <x-form-radio name="tampil_banner" value="ya" label="Ya" checked />
                                                        <x-form-radio name="tampil_banner" value="tidak" label="Tidak" />
                                                    </x-form-group>
                                                @endrole
                                            </div>

                                            @role('superadmin|operator')
                                                <x-form-group name="add_to_submenu" label="Jadikan Sub Menu" inline class="mb-2">
                                                    <x-form-radio name="add_to_submenu" value="ya" label="Ya" />
                                                    <x-form-radio name="add_to_submenu" value="tidak" label="Tidak" />
                                                </x-form-group>
                                                <x-form-group name="set_welcome_message" label="Tampilkan di awal buka website" inline class="mb-2">
                                                    <x-form-radio name="set_welcome_message" value="ya" label="Ya" />
                                                    <x-form-radio name="set_welcome_message" value="tidak" label="Tidak" />
                                                </x-form-group>
                                            @endrole
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="card-title">
                                                    META DATA
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <x-form-textarea name="meta_keywords" label="Meta Keyword" class="mb-2 h-auto" rows="3" />
                                                <x-form-textarea name="meta_description" label="Meta Deskripsi" class="mb-2 h-auto" rows="3" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <label for="" class="fw-bold">Konten</label>
                                        <x-form-textarea name="konten" floating class="mb-2 h-auto summernote" />
                                    </div>
                                @endbind
                            </div>
                            <x-form-submit class="mt-3 d-block w-100">Simpan</x-form-submit>
                        </x-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-script')
    {{-- summernote --}}
    <script src="{{ asset('vendor/summernote/summernote-lite.min.js') }}"></script>
    <script src="{{ asset('js/summernote-ext.js') }}"></script>
@endsection
