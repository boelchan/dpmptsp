@extends('layouts.app')

@section('title', $title)
@section('sub-title', 'Overview')

@section('content')
    <div class="container">
        <div class="row justify-content-center row-cards">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Detail
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="fw-bold">Instansi</div>
                            <div>{{ $kepuasan->instansi->nama }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Layanan</div>
                            <div>{{ $kepuasan->layanan->nama }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Saran / Ulasan</div>
                            <div>{!! $kepuasan->ulasan !!}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Waktu SKM</div>
                            <div>{{ tanggalJam($kepuasan->created_at) }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>No.</td>
                                    <td>Unsur</td>
                                    <td>Nilai</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kepuasan->detail as $detail)
                                    <tr>
                                        <td>{{ $detail->ikm_id }}</td>
                                        <td>{{ $detail->ikm->unsur }}</td>
                                        <td>{{ $detail->bobot }}</td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
