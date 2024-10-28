@extends('layouts.app')

@section('title', $title)
@section('sub-title', 'Rekap')

@section('content')
    <div class="container">
        <div class="row justify-content-center row-cards">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Daftar antrian
                            {{ request()->tanggal ? 'tanggal ' . request()->tanggal : 'hari ini' }}
                            <a class="text-warning" title="downlaod excel" href="{{ route('instansi.antrian.excel', [$instansi->id, 'uuid' => $instansi->uuid, 'tanggal' => request()->tanggal]) }}" target="_blank"> <i class="ti ti-download"></i></a>
                        </h3>
                        <div class="card-actions">
                            <form action="{{ route('instansi.antrian.rekap.detail', [$instansi->id, 'uuid' => $instansi->uuid]) }}" method="get">
                                <div class="input-group mb-3">
                                    <input type="input" name="tanggal" class="date form-control" value="{{ request()->tanggal }}" placeholder="{{ today() }}">
                                    <button class="btn btn-outline-secondary" type="submit">Lihat</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        {{ $instansi->nama }}
                    </div>
                    <div class="card-table">
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                    <th width="10%">No Antrian</th>
                                    <th width="20%">Jam kunjungan</th>
                                    <th width="20%">Layanan</th>
                                    <th width="20%">SKM</th>
                                    <th width="30%">Masukan</th>
                                </thead>
                                <tbody>
                                    @forelse ($antrian->detail_kunjungan as $ant)
                                        <tr>
                                            <td>{{ $ant->no_antrian }}</td>
                                            <td>{{ $ant->created_at }}</td>
                                            <td>{{ $ant->layanan_label }} </td>
                                            <td>{{ $ant->kepuasan_label }} </td>
                                            <td>{{ $ant->masukan }} </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
