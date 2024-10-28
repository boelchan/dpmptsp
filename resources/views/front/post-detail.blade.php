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
                            @if ($post->gambar)
                                <div class="mb-60 text-center">
                                    <img src="{{ $post->gambar_url }}" alt="gambar" style="max-height: 500px">
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
                            <div class="post-meta post-meta-two">
                                <div class="sh-columns post-meta-comments">
                                    <span class="post-meta-categories">
                                        <a class="badge rounded-pill bg-secondary mt-1" href="{{ route('front.post.kategori', $post->kategori->slug) }}" rel="category tag">{{ $post->kategori->nama }}</a>
                                        <a class="badge rounded-pill bg-danger mt-1" href="{{ $post->instansi_id ? $post->instansi->url : '#' }}">{{ $post->instansi_label }}</a>
                                    </span>
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
