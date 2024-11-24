@extends('front.base')

@section('content')
    @include('front.breadcrumb', ['title' => $meta['category']])

    <div class="sl-blog-details-area ptb-80 ptb-sm-40 ptb-md-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="blog-details-wrapper">
                        <article class="blog-post standard-post">
                            {{-- <div class="alert alert-secondary" role="alert"> --}}
                            <form action="{{ route('cari') }}" method="get">
                                <div class="input-group ">
                                    <input type="text" maxlength="200" name="search" value="{{ $q }}" class="form-control border-primary" placeholder="cari layanan apa ? KTP, perizinan">
                                    <button type="submit" class="btn btn-primary btn-sm" aria-label="Search"><i class="ti ti-search"></i> Cari</button>
                                </div>
                            </form>
                            {{-- </div> --}}
                            <div class="col-12 p-2">
                                @if ($q)
                                    Hasil pencarian Anda<br><br>
                                @endif

                                @foreach ($searchResults['post'] as $value)
                                    <div class="mb-2">
                                        <span>{{ $value->publish_at_label }}</span>
                                        <a class="link-dark col-md-4 col-5 m-1 alert-box bg_cat-1 p-1 ps-2 rounded" href="{{ $value->url }}">{{ ucwords(strtolower($value->judul)) }}</a>
                                    </div>
                                @endforeach
                                @foreach ($searchResults['document'] as $value)
                                    <div class="mb-2">
                                        <span>{{ $value->publish_at_label }}</span>
                                        <a class="link-dark col-md-4 col-5 m-1 alert-box bg_cat-1 p-1 ps-2 rounded" href="{{ $value->url }}">{{ ucwords(strtolower($value->title)) }}</a>
                                    </div>
                                @endforeach

                                @if ($searchResults['post']->count() == 0 && $searchResults['document']->count() == 0)
                                    <i>Informasi yang Anda cari tidak ditemukan. Silahkan gunakan kata kunci yang lebih spesifik untuk pencarian Anda.</i>
                                @endif
                            </div>
                        </article>
                    </div>
                </div>
                @include('front.sidebar')

            </div>
        </div>
    </div>
@endsection
