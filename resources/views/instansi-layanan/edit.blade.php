@extends('layouts.app')

@section('title', $title)
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
                        <x-form :action="route('instansi.layanan.update', [$layanan->id, 'uuid' => $layanan->uuid])" method="PATCH">
                            <div class="row">
                                @bind($layanan)
                                    <div class="row">
                                        <div class="col-md-4">
                                            <x-form-textarea name="nama" label="Nama Layanan <required/>" class="mb-2 h-auto" rows="2" />

                                            <x-form-group name="jenis" label="Jenis <required/>" inline>
                                                <x-form-radio name="jenis" value="perizinan" checked label="Perizinan" />
                                                <x-form-radio name="jenis" value="non_perizinan" label="Non Perizinan" />
                                            </x-form-group>

                                            <x-form-input-group label="Link Pendaftaran Online" class="fw-bold">
                                                <x-form-input-group-text>https://</x-form-input-group-text>
                                                <x-form-input name="link" />
                                            </x-form-input-group>

                                            <div class="bg-secondary-lt card-body my-3">
                                                <x-form-group name="publish" label="Publish <required/>" inline>
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
                                                    <x-form-textarea name="meta_description" label="Meta Deskripsi" class="h-auto" rows="3" />
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-8">
                                            <div class="my-2">
                                                <label class="fw-bold">Deskripsi</label>
                                                <x-form-textarea name="konten" floating class="mb-2 h-auto summernotex" />
                                            </div>
                                            <div class="my-2">
                                                <label class="fw-bold">Alur</label>
                                                <x-form-textarea name="alur" floating class="mb-2 h-auto summernotex" />
                                            </div>
                                            <div class="my-2">
                                                <label class="fw-bold">Syarat</label>
                                                <x-form-textarea name="syarat" floating class="mb-2 h-auto summernotex" />
                                            </div>
                                        </div>
                                    </div>
                                @endbind
                                <x-form-submit class="mt-3 w-100">Simpan</x-form-submit>
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

    <script>
        $('.summernotex').summernote({
            height: "200px",
            toolbar: [
                ['font', ['bold', 'italic', 'underline']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture', 'video']],
            ],
            callbacks: {
                onImageUpload: function(image) {
                    uploadImage(image[0], $(this));
                },
            }
        });
    </script>
@endsection
