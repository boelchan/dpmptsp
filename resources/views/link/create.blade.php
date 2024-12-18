@extends('layouts.app')

@section('title', $title)
@section('sub-title', 'Tambah')
@section('page-style')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/summernote/summernote-lite.min.css') }}" />
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tambah</h3>
                    </div>
                    <div class="card-body">
                        <x-form :action="route('link.store')" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-2">
                                        <label for="" class="fw-bold d-block">Icon</label>
                                        <img id="output" src="{{ asset('static/sampel.jpg') }}" class="img-fluid rounded">
                                        <x-form-input name="icon" id="icon" type="file" accept="image/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])" />
                                    </div>
                                    <x-form-textarea name="nama" label="Nama Link <required>" class="mb-2 h-auto" rows="3" />
                                    <x-form-input-group label="Alamat Link <required>">
                                        <x-form-input-group-text>https://</x-form-input-group-text>
                                        <x-form-input name="url" placeholder="alamaturl.com" id="url" />
                                    </x-form-input-group>

                                    <div class="bg-secondary-lt card-body my-2">
                                        <x-form-group name="publish" label="Publish" inline class="mb-2">
                                            <x-form-radio name="publish" value="ya" checked label="Ya" />
                                            <x-form-radio name="publish" value="tidak" label="Pending" />
                                        </x-form-group>
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
                            </div>
                            <x-form-submit class="mt-3 w-100">Simpan</x-form-submit>
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
