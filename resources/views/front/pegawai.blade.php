@extends('front.base')

@section('content')
    @include('front.breadcrumb', ['title' => $meta['category']])

    <div class="sl-blog-details-area ptb-80 ptb-sm-40 ptb-md-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="blog-details-wrapper">
                        <article class="blog-post standard-post">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="accordion gradient-style" id="accordionExample4">
                                        @foreach ($bidang as $b)
                                            <div class="card">
                                                <div class="card-header" id="heading-{{ $b->id }}">
                                                    <h5 class="mb-0">
                                                        <a href="#" class="acc-btn {{ $loop->first ? '' : 'collapsed' }}" data-bs-toggle="collapse" data-bs-target="#coll-{{ $b->id }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="coll-{{ $b->id }}">
                                                            {{ $b->nama }}
                                                        </a>
                                                    </h5>
                                                </div>
                                                <div id="coll-{{ $b->id }}" class="collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="heading-{{ $b->id }}" data-bs-parent="#accordionExample4">
                                                    <div class="card-body">
                                                        <div class="row justify-content-center">
                                                            @foreach ($b->pegawai as $p)
                                                                <div class="col-lg-4 col-md-6 col-sm-6">
                                                                    <div class="box-team team-box-it-company shadow-medium mb-30 mb-lg-0 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                                                                        <div class="team-inner-img">
                                                                            <img src="{{ $p->foto_url }}" alt="team" class="img-responsive">
                                                                        </div>
                                                                        <div class="text-center">
                                                                            <h4 class="color-black fw-normal mt-4 text-capitalize">{{ $p->nama }}</h4>
                                                                            <p class="color-light-grey font-weight-500 designation text-capitalize mb-0">
                                                                                {{ $p->jabatan }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
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
