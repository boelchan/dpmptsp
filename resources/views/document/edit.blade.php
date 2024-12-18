@extends('layouts.app')

@section('title', $title)
@section('sub-title', 'Edit')
@section('page-style')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/summernote/summernote-lite.min.css') }}" />
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit</h3>
                    </div>
                    <div class="card-body">
                        <x-form :action="route('document.update', [$document->id, 'uuid' => $document->uuid])" method="PATCH" enctype="multipart/form-data">
                            <div class="row">
                                @bind($document)
                                    <div class="">
                                        <x-form-select name="document_category_id" id="document_category_id" :options="$kategoriOption" label="Kategori <required>" placeholder="Pilih Kategori" />
                                        <x-form-input name="title" label="Nama Dokumen <required>" class="mb-2 h-auto" />

                                        <x-form-input type="file" name="file" label="Berkas <required>" accept="application/pdf">
                                            @slot('help')
                                                <small class="form-text text-muted">
                                                    File sebelumnya
                                                    <a href="{{ $document->url_berkas }}" target="_blank">Lihat <i class="ti ti-external-link"></i></a>
                                                </small>
                                            @endslot
                                        </x-form-input>

                                        <div class="bg-secondary-lt card-body my-2">
                                            <x-form-group name="publish" label="Publish" inline>
                                                <x-form-radio name="publish" value="ya" label="Ya" />
                                                <x-form-radio name="publish" value="tidak" label="Pending" />
                                            </x-form-group>
                                        </div>
                                    </div>
                                @endbind
                                <x-form-submit class="mt-3">Simpan</x-form-submit>
                            </div>
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
