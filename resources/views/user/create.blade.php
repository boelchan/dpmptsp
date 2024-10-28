@extends('layouts.app')

@section('title', 'User')
@section('sub-title', 'Tambah')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tambah User</h3>
                    </div>
                    <div class="card-body">
                        <x-form :action="route('user.store')">
                            <h3 class="mb-0">Profil</h3>
                            <x-form-input name="name" label="Nama" floating />
                            
                            <h3 class="mb-0 mt-3">Akun</h3>
                            <x-form-input name="email" label="Email" floating />
                            <div x-data="{ selectedValue: '', showInstansi: false }">
                                <x-form-select x-model="selectedValue" x-on:change="showInstansi = (selectedValue === '3')" name="role" :options="$roleOption" label="Role" placeholder="Pilih Role" floating />
                                <div x-show="showInstansi">
                                    <x-form-select name="instansi_id" :options="$instansiOption" label="Instansi"  floating />
                                </div>
                            </div>

                            <h3 class="mb-0 mt-3">Password</h3>
                            <x-form-input name="password" type="password" label="Password" floating />
                            <x-form-input name="password_confirmation" type="password" label="Konfirmasi Password" floating />
                            <x-form-submit class="mt-3">Simpan</x-form-submit>
                        </x-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
