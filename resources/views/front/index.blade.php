@extends('front.base')

@section('content')
    <section class="position-relative">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @forelse ($slider as $b)
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $loop->index }}" class="@if ($loop->first) active @endif" aria-current="true" aria-label="Slide 1"></button>
                @empty
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" class="active" aria-current="true" aria-label="Slide 1"></button>
                @endforelse
            </div>
            <div class="carousel-inner">
                @forelse ($slider as $b)
                    <div class="carousel-item @if ($loop->first) active @endif">
                        <a href="{{ $b->url }}">
                            <img src="{{ $b->gambar_url }}" class="d-block mx-auto" alt="..." style="max-height:600px">
                            <div class="carousel-caption d-none d-md-block">
                                <label class="blur rounded-pill px-3 py-1">
                                    {{ $b->judul }}
                                </label>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="carousel-item active">
                        <img src="{{ asset('storage/static/sampel.jpg') }}" class="d-block img-fluid w-100" alt="...">
                    </div>
                @endforelse
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-secondary rounded-3" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon bg-secondary rounded-3" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <section class="position-relative ptb-80 ptb-sm-40 ptb-md-60 wow fadeInUp" id="section-layanan">
        <div class="services-area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="text-center mb-4">
                        <h2 class="main-color d-inline-block">Layanan</h2>
                    </div>
                </div>
                <div class="row">
                    @foreach ($instansi as $i)
                        <div class="col-6 col-lg-3 col-md-4 mb-4 wow fadeInUp">
                            <div class="service-box text-center text-md-start orange-gradient p-4 pb-2 rounded-3 border">
                                @if ($i->icon)
                                    <img class="mb-2" src="{{ $i->icon_url }}" alt="" style="max-height: 70px">
                                @else
                                    <i class="fas fa-edit-2 fa-4x mb-2"></i>
                                @endif
                                <h4 class="fw-bold mb-0 mt-1" style="font-size: 0.9rem">{{ $i->nama }}</h4>
                                <a class="readmore" href="{{ $i->url }}"><span>Detail layanan</span></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="position-relative ptb-80 ptb-sm-30 ptb-md-60 gray-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="text-center mb-4">
                    <h2 class="main-color d-inline-block">Pamflet</h2>
                </div>
            </div>
            <div class="row ">
                <!-- Start Single Gallery -->
                @foreach ($pamflet as $pf)
                    <div class="col-md-4 col-6 p-1">
                        <a class="gallery wow fadeInUp" data-fancybox="gallery" href="{{ $pf->gambar_url }}">
                            <div class="thumb">
                                <img class="rounded-3" src="{{ $pf->gambar_url }}" alt="pamflet Images">
                            </div>
                            <div class="hover-overlay">
                                <div class="inner">
                                    <span class="ti ti-plus"></span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
                <!-- End Single Gallery -->
            </div>
        </div>
        <!-- End Gallery Area -->
    </section>

    <section class="position-relative ptb-80 ptb-sm-30 ptb-md-60 wow fadeInUp ">
        <div class="container">
            <div class="row justify-content-center">
                <div class="text-center mb-4">
                    <h2 class="main-color d-inline-block">Kabar Terbaru</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="common-owl-carousel mb-5 owl-carousel owl-theme owl-loaded owl-drag" data-nav="false" data-laptop-view="3" data-main-view="3">
                    <div class="owl-stage-outer">
                        <div class="owl-stage">
                            @foreach ($lastestPost as $post)
                                <div class="owl-item p-3">
                                    <div class="blog-post blog-classic common-blog-post item">
                                        <div class="blog-imgs" style="height: 200px">
                                            <a class="blog-img" href="{{ $post->url }}">
                                                <img src="{{ $post->gambar_url }}" alt="Blog imgs" style="height: 200px!important; object-fit: cover; ">
                                            </a>
                                        </div>
                                        <div class="blog-inner pt-2 px-4">
                                            <div class="blog-meta m-0">
                                                <a href="{{ $post->url }}"> {{ tanggal($post->approved_at) }} </a>
                                            </div>
                                            <span class="blog-title">
                                                <a class="fw-normal m-0" href="{{ $post->url }}" style="font-size: 0.9rem">
                                                    {{ Str::limit($post->judul, 55, '...') }}
                                                </a>
                                            </span>
                                            <div class="post-meta my-3">
                                                <div class="sh-columns">
                                                    <span class="post-meta-categories">
                                                        <a class="text-black d-block" href="{{ route('front.post.kategori', $post->kategori->slug) }}" rel="category tag">{{ $post->kategori->nama }}</a>
                                                        <a class="text-black" href="{{ $post->instansi_id ? $post->instansi->url : '#' }}">{{ $post->instansi_label }}</a>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="position-relative z-index-3 ptb-80 ptb-sm-40 ptb-md-60 gray-bg" id="section-pengaduan">
        <div class="container">
            <div class="row  justify-content-center">
                <div class="col-md-6 col-offset-3 position-relative">
                    <img src="{{ asset('front/img/shape/square-dots.png') }}" data-parallax='{"y": -30,"x":30}' class="square-dot-4 d-none d-sm-block" alt="shapes">
                    <div class="card p-0 p-md-4 p-lg-5 border-0 shadow-default mt-5 mt-md-0">
                        <x-form action="{{ route('front.pengaduan') }}" id="form-x">
                            <h3 class="mb-4 text-center main-color">Kotak Pengaduan</h3>
                            <div class="mb-4">
                                <x-form-input name="nama_pemohon" label="Nama Pemohon" required maxLength="50" floating/>
                            </div>
                            <div class="mb-4">
                                <x-form-input type="text" name="no_identitas" label="No Identitas (No. KTP / No. SIM / No. Passport)" required maxlength="20" floating />
                            </div>
                            <div class="mb-4">
                                <x-form-input type="text" name="telepon" label="Telepon" required maxlength="13" floating />
                            </div>
                            <div class="mb-4">
                                <x-form-select name="instansi_id" label="Instansi" required floating>
                                    <option value="">Pilih Instansi</option>
                                    @foreach ($instansi as $i)
                                        <option value="{{ $i->id }}">{{ $i->nama }}</option>
                                    @endforeach
                                </x-form-select>
                            </div>
                            <div class="mb-4">
                                <x-form-textarea name="pengaduan" label="Pengaduan" class="h-auto" rows="5" required maxlength="1000" floating/>
                            </div>
                            <button class="btn p-0 mt-20 w-100" type="submit">
                                <span class="gradients-button grad-btn-6 btn-small w-100">Kirim</span>
                            </button>
                        </x-form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
