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
                            Preview
                        </h3>
                        <div class="card-actions">
                            @role('superadmin')
                                <a href="javascript:void(0)" class="btn btn-outline-danger btn-sm delete-data" data-url="{{ route('instansi.destroy', [$instansi->id, 'uuid' => $instansi->uuid]) }}" data-token="{{ csrf_token() }}" data-label="{{ $instansi->judul }}"> Hapus </a>
                            @endrole()
                            <a href="{{ route('instansi.edit', [$instansi->id, 'uuid' => $instansi->uuid]) }}" class="btn btn-primary btn-sm">Edit</a>
                        </div>
                    </div>
                    <div class="card-body py-2">
                        <a href="{{ route('instansi.antrian', [$instansi->id, 'uuid' => $instansi->uuid]) }}" class="btn btn-warning btn-sm">Lihat Antrian</a>
                    </div>
                    <div class="card-body py-2">
                        <a href="{{ route('instansi.antrian.rekap.instansi', [$instansi->id, 'uuid' => $instansi->uuid]) }}" class="btn btn-purple btn-sm">Rekap Antrian</a>
                    </div>
                    <div class="card-body py-2">
                        @if ($instansi->publish == 'ya')
                            <span class="badge bg-lime">Publish</span>
                        @else
                            <span class="badge bg-secondary-lt ">Pending</span>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="fw-bold">Download QrCode SKM
                                <a class="fw-bold fs-2" href="{{ route('instansi.qrcode', [$instansi->id, 'uuid' => $instansi->uuid]) }}" target="_blank"> <i class="ti ti-download"></i></a>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Link SKM
                                <a class="fw-bold fs-2" href="{{ route('front.skm.create', [$instansi->id, 'uuid' => $instansi->uuid]) }}" target="_blank"> {{ route('front.skm.create', [$instansi->id, 'uuid' => $instansi->uuid]) }}</a>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Nama {{ $title }}</div>
                            <div>{{ $instansi->nama }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold">Logo</div>
                            @if ($instansi->icon)
                                <div class="row justify-content-center">
                                    <img src="{{ $instansi->icon_url }}" class="rounded">
                                </div>
                            @else
                                -
                            @endif
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    META DATA
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="fw-bold">Meta Keywords</div>
                                    <div>{{ $instansi->meta_keywords ?? '-' }}</div>
                                </div>
                                <div class="">
                                    <div class="fw-bold">Meta Description</div>
                                    <div>{{ $instansi->meta_description ?? '-' }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3" id="card-layanan">
                            <div class="card-header">
                                <div class="card-title">LAYANAN ({{ $instansi->layanan->count() }})</div>
                                <div class="card-actions">
                                    <a href="{{ route('instansi.layanan.create', [$instansi->id, 'uuid' => $instansi->uuid]) }}" class="btn btn-outline-primary btn-icon px-0">
                                        <i class="ti ti-plus fw-bold fs-2"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-table">
                                @if (Session::has('message'))
                                    <div class="alert alert-important alert-success alert-dismissible" role="alert">
                                        <div class="d-flex">
                                            <div>
                                                {{ Session::get('message') }}
                                            </div>
                                        </div>
                                        <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
                                    </div>
                                @endif
                                <table class="table table-border w-100">
                                    @forelse ($instansi->layanan as $layanan)
                                        <tr>
                                            <td width="95%" class="pe-0">
                                                <span class="d-block">{{ $layanan->nama }}</span>
                                                {!! $layanan->jenis_label !!}
                                                {!! $layanan->link_label !!}
                                                {!! $layanan->status !!}
                                            </td>
                                            <td width="5%" class="pe-2">
                                                <div class="dropdown mt-1">
                                                    <span type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ti ti-pencil fs-3 fw-bold"></i>
                                                    </span>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <li> <a class="dropdown-item" href="{{ route('instansi.layanan.edit', [$layanan->id, 'uuid' => $layanan->uuid]) }}">Ubah</a> </li>
                                                        <li> <a href="javascript:void(0)" class="dropdown-item delete-data text-red" data-url="{{ route('instansi.layanan.destroy', [$layanan->id, 'uuid' => $layanan->uuid]) }}" data-token="{{ csrf_token() }}" data-label="{{ $layanan->nama }}"> Hapus </a> </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>Belum ada layanan</td>
                                        </tr>
                                    @endforelse
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        {!! $instansi->konten ?? 'Belum ada konten' !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
