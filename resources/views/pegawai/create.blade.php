@extends('layouts.app')

@section('title', $title)
@section('sub-title', 'Tambah')
@section('page-style')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/summernote/summernote-lite.min.css') }}" />
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tambah</h3>
                    </div>
                    <div class="card-body">
                        <x-form :action="route('pegawai.store')" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-2">
                                        <label for="" class="fw-bold d-block">Foto</label>
                                        <img id="output" src="{{ asset('static/sampel.jpg') }}" class="img-fluid rounded">
                                        <x-form-input name="foto" id="foto" type="file" accept="image/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])" />
                                    </div>
                                    <x-form-select name="bidang_id" label="Bidang <required>" :options="$bidangOption" class="mb-2" />
                                    <x-form-input name="nama" label="Nama <required>" class="mb-2" />
                                    <x-form-input name="jabatan" label="Jabatan <required>" class="mb-2" />

                                    <div class="bg-secondary-lt card-body my-2">
                                        <x-form-group name="is_leader" label="Kepala Bidang" inline class="mb-2">
                                            <x-form-radio name="is_leader" value="ya" label="Ya" />
                                            <x-form-radio name="is_leader" value="tidak" checked label="Tidak" />
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
