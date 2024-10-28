@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="container">
        <div class="col-md-12">

            <x-datatable.filter target='instansi-table' collapsed="true">
                <div class="col-md-3">
                    <x-form-input name="nama" id="nama" label="Nama instansi" floating />
                </div>
                <div class="col-md-3">
                    <x-form-select name="status" id="status" :options="['' => 'Semua', 'ya' => 'Aktif', 'tidak' => 'Tidak Aktif']" label="Status" placeholder="Pilih Status" floating />
                </div>
            </x-datatable.filter>

            <div class="card">
                <div class="card-table">
                    {{ $dataTable->table(['class' => 'table table-hover table-sm w-100 border-bottom']) }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
    <script src="{{ asset('js/datatables/actions.js') }}"></script>
    {{ $dataTable->scripts() }}
@endsection
