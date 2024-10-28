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
                            Antrian
                        </div>
                        <div class="card-actions">
                            <form action="{{ route('instansi.antrian', [$instansi->id]) }}" method="get">
                                <div class="input-group mb-3">
                                    <input type="hidden" name="uuid" value="{{ $instansi->uuid }}">
                                    <input type="input" name="tanggal" class="date form-control" value="{{ request()->tanggal }}" placeholder="{{ today() }}">
                                    <button class="btn btn-outline-secondary" type="submit">Lihat</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body py-2">
                        <div class="col-md-12">
                            <label class="fs-3 fw-bold">{{ $instansi->nama }}</label>
                            <div class="row fs-3">
                                <label>
                                    @if (request()->tanggal)
                                        Daftar antrian tanggal {{ request()->tanggal }}
                                    @else
                                        Daftar antrian hari ini
                                    @endif
                                    <a class="text-primary" title="downlaod excel" href="{{ route('instansi.antrian.excel', [$instansi->id, 'uuid' => $instansi->uuid, 'tanggal' => request()->tanggal]) }}" target="_blank"> <i class="ti ti-download"></i></a>
                                </label>
                            </div>
                            <div class="row row-cards">
                                @if ($antrian)
                                    @forelse ($antrian->detail_kunjungan as $an)
                                        <div class="card col-md-2 me-1">
                                            <div class="card-body p-1">
                                                <span class="fs-1 fw-bold me-3">{{ $an->no_antrian }}</span>
                                                {{ Str::substr($an->created_at, 11, 8) }}
                                            </div>
                                            <div class="card-footer p-0">
                                                {{ $an->layanan_label }}
                                            </div>
                                            <div class="card-footer p-0">
                                                @if ($an->layanan_id)
                                                    <button type="button" class="btn btn-success btn-xs p-1 w-100 btn-layani" data-id="{{ $an->id }}" data-layanan_id="{{ $an->layanan_id }}"> Ubah </button>
                                                @else
                                                    <button type="button" class="btn btn-primary btn-xs p-1 w-100 btn-layani" data-id="{{ $an->id }}" data-layanan_id="{{ $an->layanan_id }}"> Layani </button>
                                                @endif
                                            </div>
                                        </div>
                                    @empty
                                        <i class="text-secondary fs-3">Belum ada antrian</i>
                                    @endforelse
                                @else
                                    <i class="text-secondary fs-3">Belum ada antrian</i>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal_layani" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pilih Layanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('instansi.simpan_layanan_antrian') }}" method="post">
                        @csrf
                        <input type="hidden" name="antrian_detail_id" id="antrian_detail_id">
                        <div class="col-md-12 mb-2">
                            @foreach ($instansi->layananAktif as $la)
                                <div class="form-check">
                                    <input class="form-check-input form_layanan_id" type="radio" name="layanan_id" value="{{ $la->id }}" id="rd{{ $la->id }}">
                                    <label class="form-check-label" for="rd{{ $la->id }}">
                                        {{ $la->nama }}
                                    </label>
                                </div>
                            @endforeach
                            <div class="form-check">
                                <input class="form-check-input form_layanan_id" type="radio" name="layanan_id" value="999999" id="rd999999">
                                <label class="form-check-label" for="rd999999">
                                    Lainnya
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-script')
    <script>
        $('.btn-layani').click(function(e) {
            $('#modal_layani').modal('show')
            $('#antrian_detail_id').val($(this).data('id'))

            var layanan_id = $(this).data('layanan_id')
            const radioButton = Array.from(document.querySelectorAll('input.form_layanan_id'))
                .find(radio => radio.value == layanan_id);

            if (radioButton) {
                radioButton.checked = true;
            } else {
                Array.from(document.querySelectorAll('input.form_layanan_id'))
                    .find(radio => radio.value == 999999)
                    .checked = true;
            }

        });
    </script>
@endsection
