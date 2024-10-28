@extends('front.base')

@section('content')
    @include('front.breadcrumb', ['title' => $meta['category']])

    <div class="sl-blog-details-area ptb-80 ptb-sm-40 ptb-md-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="blog-details-wrapper">
                        <article class="blog-post standard-post">
                            <!-- Start Thumbnail -->
                            @if ($post->icon)
                                <div class="mb-60 text-center">
                                    <img src="{{ $post->icon_url }}" alt="icon" style="max-height: 200px">
                                </div>
                            @endif
                            <!-- Start Title -->
                            <div class="header mb-40 text-center">
                                <h3 class="fw-normal">{{ $meta['title'] }}</h3>
                                <div class="post-meta mt-20 justify-content-center">
                                    <div class="post-date">{{ $post->publish_at_label }}</div>
                                </div>
                            </div>
                            <!-- Start Content -->
                            <div class="content basic-dark2-line-1px pb-50 mb-35">
                                <div class="inner">
                                    {!! $post->konten !!}
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
