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
                            Jumlah antrian
                            {{ request()->tanggal ? 'tanggal ' . request()->tanggal : 'hari ini' }}
                            >> {{ $jumlahAntrian }}
                            <a class="text-warning" title="downlaod excel" href="{{ route('instansi.antrian.rekap.excel', ['tanggal' => request()->tanggal]) }}" target="_blank"> <i class="ti ti-download"></i></a>
                        </h3>
                        <div class="card-actions">
                            <form action="{{ route('instansi.antrian.rekap') }}" method="get">
                                <div class="input-group mb-3">
                                    <input type="input" name="tanggal" class="date form-control" value="{{ request()->tanggal }}" placeholder="{{ today() }}">
                                    <button class="btn btn-outline-secondary" type="submit">Lihat</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-table">
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                    <th>No</th>
                                    <th>Instansi</th>
                                    <th>Jumlah Antrian</th>
                                </thead>
                                <tbody>
                                    @forelse ($instansi as $ins)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $ins->nama }}</td>
                                            <td>
                                                {{ $ins->jumlahAntrianInstansi }}
                                                @if ($ins->jumlahAntrianInstansi)
                                                    <a href="{{ route('instansi.antrian.rekap.detail', [$ins->id, 'uuid' => $ins->uuid, 'tanggal' => request()->tanggal]) }}" class="btn btn-info btn-sm">Detail</a>
                                                @endif
                                            </td>
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
