@extends('layouts.app')

@section('title', 'Pengaturan Website')

@section('content')
    <div class="container">
        <div class="col-md-12 mb-4">
            <div class="row row-cards">
                <h3>Identitas</h3>
                @foreach ($identitas as $iden)
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title me-2">{{ $iden->nama }}</h3>
                                <a href="{{ route('identitas.edit', $iden->slug) }}"><i class="ti ti-pencil fs-3"></i></a>
                            </div>
                            <div class="card-body">
                                <span>{{ $iden->value }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        
        <div class="col-md-12 mb-4">
            <h3>Sosial Media</h3>
            <div class="row justify-content-center row-cards">
                @foreach ($sosmed as $iden)
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title me-2">{{ $iden->nama }}</h3>
                                <a href="{{ route('identitas.edit', $iden->slug) }}"><i class="ti ti-pencil fs-3"></i></a>
                            </div>
                            <div class="card-body">
                                @if ($iden->value)
                                    {{ $iden->value }} <a href="{{ $iden->value }}" target="_blank" rel="noopener noreferrer" title="lihat"><i class="ti ti-external-link"></i></a>
                                @else
                                  <i>tidak ada</i>  
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="col-md-12 mb-4">
            <div class="row row-cards">
                <h3>Website</h3>
                @foreach ($website as $iden)
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title me-2">{{ $iden->nama }}</h3>
                                <a href="{{ route('identitas.edit', $iden->slug) }}"><i class="ti ti-pencil fs-3"></i></a>
                            </div>
                            <div class="card-body">
                                <img id="output" src="{{ $iden->value ? asset('storage/static/' . $iden->value) : '' }}" class="img-fluid rounded">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
