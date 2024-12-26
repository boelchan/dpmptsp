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
                            <img src="{{ $b->gambar_url }}" class="d-block w-100 d-md-none" alt="..." style="object-fit: cover; max-height: 220px;">
                            <img src="{{ $b->gambar_url }}" class="d-none d-md-block w-100" alt="..." style="object-fit: cover; max-height: 600px;">
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
    <div class="position-relative ptb-80 ptb-md-60 ptb-sm-40 gray-bg" style="background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0.8)), url('{{ setting('footer') }}'); background-size: cover; background-repeat: no-repeat; background-position: center;">
        <div class="container" data-wow-duration="1.5s">
            <div class="brand-area grid-style position-relative">
                <div data-wow-duration="1.5s">
                    <div class="row mb-3 text-center g-0">
                        @foreach ($link as $l)
                            <div class="col-md-3 col-6 ">
                                <div class="brand py-2">
                                    <a href="https://{{ $l->url }}"><img src="{{ $l->icon_url }}" alt="client"></a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="position-relative w-100 ptb-80 ptb-sm-40 ptb-md-50 overflow-hidden z-index-2">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12 col-lg-6">
                    <div class="position-relative image-block bg-cover bg-center text-center fadeInLeft wow">
                        <img src="{{ $sambutan->gambar_url }}" alt="madical-image">
                    </div>
                </div>
                <div class="col-md-12 col-lg-6">
                    <div class="section-title text-center text-lg-start section-heading">
                        <h2 class="fs-1 text-primary">Selamat Datang di Website DPMPTSP Kab. Sumenep</h2>
                        {!! Str::take($sambutan->konten, 500) !!} ... <br>
                        <a href="{{ route('front.post.baca', $sambutan->slug) }}" class="btn p-0 mt-25">
                            <span class="gradients-button btn-small grad-btn-5">Baca Selengkapnya</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="position-relative ptb-80 ptb-sm-30 ptb-md-60 gray-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="text-center mb-4">
                    <h2 class="text-primary d-inline-block fs-1">Pamflet</h2>
                </div>
            </div>
            <div class="row ">
                <!-- Start Single Gallery -->
                @foreach ($pamflet as $pf)
                    <div class="col-md-4 col-6 p-1">
                        <a class="gallery wow fadeInUp" data-fancybox="gallery" href="{{ $pf->gambar_url }}">
                            <div class="thumb">
                                <img class="rounded-3" src="{{ $pf->gambar_url }}" alt="pamflet Images" style="max-height: 250px; object-fit: cover;">
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
                    <h2 class="text-primary d-inline-block fs-1">Tajuk Berita</h2>
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
                                                <a href="{{ $post->url }}"> {{ $post->publish_at_label }} </a>
                                            </div>
                                            <span class="blog-title">
                                                <a class="" href="{{ $post->url }}">
                                                    {{ Str::limit($post->judul, 55, '...') }}
                                                </a>
                                            </span>
                                            <div class="post-meta my-3">
                                                <div class="sh-columns">
                                                    <span class="post-meta-categories">
                                                        <a class="btn btn-outline-primary py-0" href="{{ route('front.post.kategori', $post->kategori->slug) }}" rel="category tag">{{ $post->kategori->nama }}</a>
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
                        <x-form action="{{ route('front.pengaduan') }}" class="p-2" id="form-x">
                            <h3 class="mb-4 text-center text-primary fs-1">Kotak Pengaduan</h3>
                            <div class="mb-4">
                                <x-form-input name="nama_pemohon" label="Nama Pemohon" required maxLength="50" floating />
                            </div>
                            <div class="mb-4">
                                <x-form-input type="number" name="telepon" label="No Telepon" required maxlength="13" floating />
                            </div>
                            <div class="mb-4">
                                <x-form-input type="email" name="email" label="Email" required floating />
                            </div>
                            <div class="mb-4">
                                <x-form-textarea name="pengaduan" label="Isi Pengaduan" class="h-auto" rows="5" required maxlength="1000" floating />
                            </div>
                            <button class="btn p-0 mt-20 w-100" type="submit">
                                <span class="gradients-button grad-btn-5 btn-small w-100">Kirim</span>
                            </button>
                        </x-form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="modal-welcome" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content p-1">
                <div class="modal-header p-1">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-1">
                    @if ($welcome_post->gambar)
                        <div class="mb-60 text-center">
                            <img src="{{ $welcome_post->gambar_url }}" alt="gambar" style="max-height: 500px">
                        </div>
                    @endif
                    {!! $welcome_post->konten !!}
                </div>
                <div class="modal-footer p-0">
                    <button type="button" class="btn btn-secondary py-0" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
    <script>
        setTimeout(() => {
            $('#modal-welcome').modal('show')
        }, 1000);
    </script>
@endsection
