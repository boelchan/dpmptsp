@extends('layouts.app')

@section('title', 'User')

@section('content')
    <div class="container-xl">
        <div class="col-md-12">

            <x-datatable.filter target='user-table' collapsed="true">
                <div class="col-md-3">
                    <x-form-input name="name" id="name" label="Nama" floating />
                </div>
                <div class="col-md-3">
                    <x-form-input name="email" id="email" label="Email" floating />
                </div>
                <div class="col-md-3">
                    <x-form-select name="role" id="role" :options="$roleOption" label="Role" placeholder="Pilih Role" floating />
                </div>
                <div class="col-md-3">
                    <x-form-select name="status" id="status" :options="['' => 'Semua', 'aktif' => 'Aktif', 'tidakAktif' => 'Tidak Aktif']" label="Status" placeholder="Pilih Status" floating />
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
