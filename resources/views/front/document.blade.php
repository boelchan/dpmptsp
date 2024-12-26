@extends('front.base')

@section('content')
    @include('front.breadcrumb', ['title' => $meta['category']])

    <div class="ptb-80 ptb-sm-40 ptb-md-60">
        <div class="container">
            <div class="row gallery-wrapper masonry-wrap justify-content-center masonary-row m-0 w-100">
                @forelse ($post as $p)
                    <div class="col-lg-6 col-md-6 mb-30 masonary-item wow fadeInUp">
                        <div class="blog-post blog-classic common-blog-post border rounded shadow-sm">
                            <div class="blog-inner p-3">
                                <div class="m-0 p-0">
                                    <span class=""><i class="ti ti-calendar"></i> {{ $p->publish_at_label }}</span>
                                </div>
                                <span class="blog-title fs-5 text-capitalize">{{ Str::limit($p->title, 55, '...') }}</span>
                                <br>
                                <a href="{{ asset('storage/document/' . $p->file) }}" class="btn btn-outline-primary py-0 " target="_blank" rel="noopener noreferrer"> <i class="ti ti-download"></i> Download File</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <span class="text-center">Tidak ada dokumen</span>
                @endforelse
            </div>
            {{ $post->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>
@endsection
