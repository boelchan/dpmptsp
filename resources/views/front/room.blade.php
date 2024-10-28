@extends('front.base')

@section('content')
    @include('front.breadcrumb', ['title' => $meta['category']])

    <div class="sl-blog-details-area ptb-80 ptb-sm-40 ptb-md-60">
        <div class="container">
            <div class="row ">
                <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="blog-details-wrapper">
                        <article class="blog-post standard-post">
                            <!-- Start Thumbnail -->
                            @if ($detail->url_gambar)
                                <div class="mb-60 text-center">
                                    <img src="{{ $detail->url_gambar }}" alt="gambar" style="max-height: 500px">
                                </div>
                            @endif
                            <div class="row mb-60">
                                @foreach ($post as $p)
                                    <div class="col-6 col-md-6 col-lg-4">
                                        <a href="{{ route('front.ranap.baca', $p->slug) }}">
                                            <div class="icon-box horizontal-icon-box no-border text-start mb-20">
                                                <div class="inner text-center text-md-start shadow-medium p-4">
                                                    <div class="d-flex flex-column flex-md-row align-items-center">
                                                        <div class="icon-3 style-2 rounded-circle me-0 me-lg-2">
                                                            <img src="{{ $p->icon_url }}">
                                                        </div>
                                                        <div class="content mt-20 mt-md-0">
                                                            <h5 class="heading heading-h5 mb-0 fw-normal fs-5">{{ $p->nama }}</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                            <!-- Start Title -->
                            {{-- <div class="header mb-40 text-center">
                                <h3 class="fw-normal">{{ $meta['title'] }}</h3>
                            </div> --}}
                            <!-- Start Content -->
                            <div class="content basic-dark2-line-1px pb-50 mb-35">
                                <div class="inner">
                                    {!! $detail->konten !!}
                                </div>
                            </div>

                        </article>
                    </div>
                </div>
                @include('front.sidebar')

            </div>
        </div>
    </div>
@endsection
