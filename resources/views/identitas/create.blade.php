@extends('layouts.app')

@section('title', 'Agenda')
@section('sub-title', 'Tambah')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tambah</h3>
                    </div>
                    <div class="card-body">
                        <x-form :action="route('post.agenda.store')" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-2">
                                        <label for="">Gambar</label>
                                        <img id="output" src="{{ asset('static/sampel.jpg') }}" class="img-fluid rounded">
                                        <x-form-input name="gambar" id="gambar" type="file" accept="image/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])" />
                                    </div>
                                    <x-form-textarea name="judul" label="Judul" class="mb-2 h-auto" rows="3" />
                                    <x-form-textarea name="meta_keywords" label="Meta Keyword" class="mb-2 h-auto" rows="3" />
                                    <x-form-textarea name="meta_description" label="Meta Deskripsi" class="mb-2 h-auto" rows="3" />

                                    <x-form-input type="date" name="tanggal" label="Tanggal Agenda" class="mb-2" />

                                    <div x-data="{ open: true }" class=" bg-secondary-lt p-3 mb-2">
                                        <x-form-group name="publish" label="Terbitkan Agenda" inline class="mb-2">
                                            <x-form-radio name="publish" value="ya" label="Ya" checked x-on:click="open = true" />
                                            <x-form-radio name="publish" value="tidak" label="Pending" x-on:click="open = false" />
                                        </x-form-group>
                                        <div x-show="open">
                                            <x-form-input name="publish_at" label="Tanggal Publish" type="date" class="mb-2" value="{{ date('Y-m-d') }}" />
                                            <x-form-group name="tampil_banner" label="Tampilkan di Banner" inline>
                                                <x-form-radio name="tampil_banner" value="ya" label="Ya" />
                                                <x-form-radio name="tampil_banner" value="tidak" label="Tidak" checked />
                                            </x-form-group>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <label for="">Konten</label>
                                    <x-form-textarea name="konten" floating class="mb-2 h-auto summernote" />
                                </div>
                                <x-form-submit class="mt-3">Simpan</x-form-submit>
                            </div>
                        </x-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
