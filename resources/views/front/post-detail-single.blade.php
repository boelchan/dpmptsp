@extends('front.base')

@section('content')
    @include('front.breadcrumb', ['title' => $meta["category"]])

    <div class="sl-blog-details-area ptb-80 ptb-sm-40 ptb-md-60">
        <div class="container">
            <div class="row justify-content-center mb-85">
                <div class="col-lg-12">
                    <div class="blog-modern-layout">
                        <div class="thumbnail text-center mb-60">
                            @if ($post->url_gambar)
                                <div class="thumbnail">
                                    <img src="{{ $post->url_gambar }}" alt="img" style="max-height: 500px; ">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 order-1 order-lg-2">
                    <div class="blog-details-wrapper">
                        <article class="blog-post blog-modern-layout">
                            <div class="header mb-40 text-center">
                                <h3 class="fw-normal">{{ $meta["title"] }}</h3>
                                <div class="post-meta mt-20 justify-content-center">
                                    <div class="post-date">{{ $post->publish_date }}</div>
                                </div>
                            </div>
                            <div class="content basic-dark2-line-1px pb-50 mb-35">
                                <div class="inner">
                                    {!! $post->konten !!}
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
