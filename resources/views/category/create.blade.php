@extends('layouts.app')

@section('title', 'Category')
@section('sub-title', 'Tambah')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tambah</h3>
                    </div>
                    <div class="card-body">
                        <x-form :action="route('category.store')">
                            <div class="row">
                                <div class="col-md-12">
                                    <x-form-input name="nama" label="Nama <required>" class="mb-2 h-auto" rows="3" />
                                    <x-form-group name="add_to_header_menu" label="Tampilkan di Header Menu" inline class="mb-2">
                                        <x-form-radio name="add_to_header_menu" value="ya" label="Ya" />
                                        <x-form-radio name="add_to_header_menu" value="tidak" label="Tidak" checked />
                                    </x-form-group>
                                    <x-form-group name="add_to_footer_menu" label="Tampilkan di Footer Menu" inline class="mb-2">
                                        <x-form-radio name="add_to_footer_menu" value="ya" label="Ya" />
                                        <x-form-radio name="add_to_footer_menu" value="tidak" label="Tidak" checked />
                                    </x-form-group>
                                    <x-form-group name="add_to_sidebar_menu" label="Tampilkan di Sidebar Menu" inline class="mb-2">
                                        <x-form-radio name="add_to_sidebar_menu" value="ya" label="Ya" />
                                        <x-form-radio name="add_to_sidebar_menu" value="tidak" label="Tidak" checked />
                                    </x-form-group>
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
