@extends('front.base')

@section('content')
    @include('front.breadcrumb', ['title' => $meta['category']])

    <div class="ptb-80 ptb-sm-40 ptb-md-60">
        <div class="container">
            <div class="row gallery-wrapper masonry-wrap justify-content-center masonary-row m-0 w-100">
                @foreach ($post as $p)
                    <div class="col-lg-4 col-md-4 mb-30 masonary-item wow fadeInUp">
                        <div class="blog-post blog-classic common-blog-post">
                            <div class="blog-imgs" style="height: 200px">
                                <a class="blog-img" href="{{ $p->url }}">
                                    <img src="{{ $p->gambar_url }}" alt="Blog imgs" style="height: 200px!important; object-fit: cover; ">
                                </a>
                            </div>
                            <div class="blog-inner p-3" style="height: 150px">
                                <div class="m-0 p-0">
                                    <a class="text-black d-block m-0" href="{{ $p->instansi_id ? $p->instansi->url : '#' }}">{{ $p->instansi_label }}</a>
                                    <span class="">{{ $p->publish_at_label }}</span>
                                </div>
                                <span class="blog-title"><a class="fs-5" href="{{ $p->url }}">{{ Str::limit($p->judul, 55, '...') }}</a></span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $post->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>
@endsection
