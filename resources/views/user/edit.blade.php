@extends('layouts.app')

@section('title', 'User')
@section('sub-title', 'Edit')

@section('content')
    <div class="container">
        <div class="row row-cards justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Ubah Profil</h3>
                    </div>
                    <div class="card-body">
                        <x-form :action="route('user.update', $user->id)" method="PATCH">
                            @bind($user)
                                <h3 class="mb-0">Profil</h3>
                                <x-form-input name="name" label="Nama" floating class="mb-1" />

                                <h3 class="mb-0 mt-3">Akun</h3>
                                <x-form-input name="email" label="Email" floating class="mb-1" />
                            @endbind
                            <x-form-submit class="mt-3">Simpan</x-form-submit>
                        </x-form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Ubah Password</h3>
                    </div>
                    <div class="card-body">
                        <x-form :action="route('user.change-password', $user->id)">
                            <h3 class="mb-0">Profil</h3>
                            <x-form-input name="password" type="password" label="Password" floating class="mb-1" />
                            <x-form-input name="password_confirmation" type="password" label="Konfirmasi Password" floating class="mb-1" />

                            <x-form-submit class="mt-3">Simpan</x-form-submit>
                        </x-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
