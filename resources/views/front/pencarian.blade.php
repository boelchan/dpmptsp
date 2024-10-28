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
                                @forelse ($searchResults->groupByType() as $type => $modelSearchResults)
                                    <div class="mt-3">
                                        <span class="fw-bold fs-5">{{ $type }}</span>
                                        <div class="row col-12 m-0">
                                            @foreach ($modelSearchResults as $searchResult)
                                                @if ($type == 'Poli')
                                                    <a class="link-dark col-md-4 col-5 m-1 alert-box bg_cat-2 p-1 ps-2 rounded" href="{{ $searchResult->url }}">{{ ucwords(strtolower($searchResult->title)) }}</a>
                                                @elseif ($type == 'Ruangan')
                                                    <a class="link-dark col-md-4 col-5 m-1 alert-box bg_cat-3 p-1 ps-2 rounded" href="{{ $searchResult->url }}">{{ ucwords(strtolower($searchResult->title)) }}</a>
                                                @elseif ($type == 'Pelayanan')
                                                    <a class="link-dark col-md-4 col-5 m-1 alert-box bg_cat-1 p-1 ps-2 rounded" href="{{ $searchResult->url }}">{{ ucwords(strtolower($searchResult->title)) }}</a>
                                                @elseif ($type == 'Dokter')
                                                    <a class="link-dark col-md-5 col-5 m-1 alert-box bg_cat-1 p-1 ps-2 rounded" href="{{ $searchResult->url }}">{{ ucwords(strtolower($searchResult->title)) }}</a>
                                                @else
                                                    <a class="link-dark  m-1 alert-box bg_cat-1 p-1 ps-2 rounded" href="{{ $searchResult->url }}">{{ ucwords(strtolower($searchResult->title)) }}</a>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @empty
                                    <i>Informasi yang Anda cari tidak ditemukan. Silahkan gunakan kata kunci yang lebih spesifik untuk pencarian Anda.</i>
                                @endforelse
                            </div>
                        </article>
                    </div>
                </div>
                @include('front.sidebar')

            </div>
        </div>
    </div>
@endsection
