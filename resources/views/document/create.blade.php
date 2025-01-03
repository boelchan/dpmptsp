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
                        <x-form :action="route('document.store')" enctype="multipart/form-data">
                            <div class="row">
                                <div class="">
                                    <x-form-select name="document_category_id" id="document_category_id" :options="$kategoriOption" label="Kategori <required>" placeholder="Pilih Kategori" />
                                    <x-form-input name="title" label="Nama Layanan / SAKIP <required>" class="mb-2 h-auto" />
                                    <x-form-input type="file" name="file" label="Berkas <required>" accept="application/pdf" />

                                    <div class="bg-secondary-lt card-body my-2">
                                        <x-form-group name="publish" label="Publish" inline class="mb-2">
                                            <x-form-radio name="publish" value="ya" checked label="Ya" />
                                            <x-form-radio name="publish" value="tidak" label="Pending" />
                                        </x-form-group>
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
