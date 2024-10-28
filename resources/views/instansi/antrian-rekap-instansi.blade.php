@extends('layouts.app')

@section('title', $title)
@section('sub-title', 'Overview')

@section('content')
    <div class="container">
        <div class="row justify-content-center row-cards">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Rekap Antrian
                        </div>
                    </div>
                    <div class="card-body py-2">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <form action="{{ route('instansi.antrian.rekap.instansi', [$instansi->id]) }}" method="get">
                                        <div class="input-group mb-3">
                                            <input type="hidden" name="uuid" value="{{ $instansi->uuid }}">
                                            <input type="input" name="tanggal" class="date-range form-control" value="{{ request()->tanggal }}" placeholder="Silahkan pilih tanggal">
                                            <button class="btn btn-outline-secondary" type="submit">Lihat</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table">
                                        <thead>
                                            <th>Tanggal</th>
                                            <th>Jumlah Antrian</th>
                                        </thead>
                                        <tbody>
                                            @php
                                                $total = 0;
                                            @endphp
                                            @foreach ($antrian as $v)
                                                @php
                                                    $total += $v->no_antrian_sekarang;
                                                @endphp
                                                <tr>
                                                    <td>{{ $v->tanggal }}</td>
                                                    <td>
                                                        {{ $v->no_antrian_sekarang }}
                                                        <a href="{{ route('instansi.antrian', [$instansi->id, 'uuid' => $instansi->uuid, 'tanggal' => $v->tanggal]) }}" class="btn btn-primary btn-sm">Detail</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td>Total</td>
                                                <td>{{ $total }}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
    <script>
        flatpickr(".date-range", {
            allowInput: false,
            "locale": "id",
            mode: "range",
        });
    </script>
@endsection
