@extends('front.base')

@section('content')
    @include('front.breadcrumb', ['title' => $meta['category']])

    <div class="sl-blog-details-area ptb-80 ptb-sm-40 ptb-md-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="col-md-12 mb-30">
                        <h3 class="fw-normal">Survei Kepuasan Masyarakat</h3>
                        <div class="blog-post blog-classic blog-horizontal p-4">
                            <x-form :action="route('front.skm.store', [$instansi->id, 'uuid' => $instansi->uuid])" id="form-x">
                                <div class="row">
                                    <h2>{{ $instansi->nama }}</h2>
                                    <div>
                                        <label for="">Layanan</label>
                                        <select name="layanan_id" required>
                                            @foreach ($instansi->layanan as $layan)
                                                <option value="{{ $layan->id }}">{{ $layan->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @foreach ($ikm as $i)
                                        <div class="mt-3">
                                            <label for="">{{ $i->unsur }}</label>
                                            <input type="hidden" name="unsur_id[]" value="{{ $i->id }}">
                                            <div class="row">
                                                <input class="col-11" type="range" name="bobot[]" value="0" min="0" max="100" oninput="this.nextElementSibling.value = this.value">
                                                <output class="col-1">0</output>
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="mt-3">
                                        <label for="">Saran / Ulasan</label>
                                        <x-form-textarea name="ulasan" class="mb-2 h-auto" required/>
                                    </div>
                                    <x-form-submit class="mt-3">Kirim Survei</x-form-submit>
                                </div>
                            </x-form>
                        </div>
                    </div>
                </div>
                @include('front.sidebar')

            </div>
        </div>
    </div>
@endsection
