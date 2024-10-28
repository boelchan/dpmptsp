@extends('layouts.app')

@section('title', 'identitas')
@section('sub-title', 'Edit')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit {{ $identitas->nama }}</h3>
                    </div>
                    <div class="card-body">
                        <x-form :action="route('identitas.update', $identitas->id)" method="PATCH" enctype="multipart/form-data">
                            <div class="">
                                @bind($identitas)
                                    @if ($identitas->tipe == 'website')
                                        <div class="form-group mb-2">
                                            <img id="output" src="{{ $identitas->value ? asset('storage/static/' . $identitas->value) : '' }}" class="img-fluid rounded">
                                            <x-form-input name="value" id="" type="file" accept="image/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])" />
                                        </div>
                                    @else
                                        <x-form-input name="value" />
                                    @endif
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
