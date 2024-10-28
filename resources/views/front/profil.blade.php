@extends('front.base')

@section('content')
    @include('front.breadcrumb', ['title' => $meta['category']])

    <div class="ptb-80 ptb-sm-40 ptb-md-60">
        <div class="container">
            <div class="row ">
                @foreach ($post as $p)
                    <div class="col-6 col-md-6 col-lg-4">
                        <a href="{{ route('front.profil.baca', $p->slug) }}">
                            <div class="icon-box horizontal-icon-box no-border text-start mb-20 mb-lg-0">
                                <div class="inner text-center text-md-start shadow-medium p-4">
                                    <div class="d-flex flex-column flex-md-row align-items-center">
                                        <div class="icon-3 style-2 rounded-circle me-0 me-lg-2">
                                            <i class="fa fa-hospital text-color"></i>
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
        </div>
    </div>
@endsection
