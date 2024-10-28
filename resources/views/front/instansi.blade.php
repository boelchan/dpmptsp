@extends('front.base')

@section('content')
    @include('front.breadcrumb', ['title' => $meta['category']])

    <div class="sl-blog-details-area ptb-80 ptb-sm-40 ptb-md-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="blog-details-wrapper">
                        <article class="blog-post standard-post">
                            @if ($post->gambar)
                                <div class="mb-60 text-center">
                                    <img src="{{ $post->gambar_url }}" alt="gambar" style="max-height: 500px">
                                </div>
                            @endif
                            <!-- Start Title -->
                            <div class="header mb-40 text-center">
                                <h3 class="fw-normal">Layanan {{ $meta['title'] }}</h3>
                                <div class="post-meta mt-20 justify-content-center">
                                    <div class="post-date">{{ $post->publish_at_label }}</div>
                                </div>
                            </div>
                            <div class="row mb-60">
                                @foreach ($post->layananAktif as $p)
                                    <div class="col-md-6 col-lg-6">
                                        <a href="javascript:handleDetailLayanan('{{ route('front.layanan', $p->slug) }}');">
                                            <div class="icon-box horizontal-icon-box no-border text-start mb-20">
                                                <div class="inner text-center text-md-start shadow-medium p-4">
                                                    <div class="d-flex flex-column flex-md-row align-items-center">
                                                        {{-- <div class="icon-3 style-2 rounded-circle me-2 p-2">
                                                    <i class="ti ti-edit-2"></i>
                                                </div> --}}
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

    <!-- Modal -->
    <div class="modal fade" id="detailLayananModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title-content"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-labelG="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Jenis Layanan : <span id="jenis"></span></p>
                    <p id="link-content">Layanan ini bisa diakses secara online melalui situs <a id="link" href=""></a></p>
                    <p id="deskripsi-content"></p>

                    <ul class="nav nav-tabs" id="myTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="alur-tab" data-bs-toggle="tab" href="#alur" role="tab" aria-controls="alur" aria-selected="true">Alur</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="syarat-tab" data-bs-toggle="tab" href="#syarat" role="tab" aria-controls="syarat" aria-selected="false">Syarat-syarat</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="alur" role="tabpanel" aria-labelledby="alur-tab">
                            <div id="alur-content"></div>
                        </div>
                        <div class="tab-pane fade" id="syarat" role="tabpanel" aria-labelledby="syarat-tab">
                            <div id="syarat-content"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-script')
    <script>
        function handleDetailLayanan(url) {
            $.ajax({
                type: "get",
                url: url,
                beforeSend: function(data) {
                    $('#detailLayananModal').modal('show')
                    $('#title-content').html('Mohon menunggu sebentar...')
                    $('#jenis').html('')
                    $('#link-content').hide()
                    $('#link').html('')
                    $('#link').attr('href', '#')
                    $('#deskripsi-content').html('')
                    $('#alur-content').html('')
                    $('#syarat-content').html('')
                },
                success: function(data) {
                    $('#jenis').html(data.layanan.jenis)
                    if (data.layanan.link) {
                        $('#link-content').show()
                        $('#link').html(data.layanan.link)
                        $('#link').attr('href', 'https://' + data.layanan.link)
                    }
                    $('#title-content').html(data.layanan.nama)
                    $('#deskripsi-content').html(data.layanan.konten)
                    $('#alur-content').html(data.layanan.alur)
                    $('#syarat-content').html(data.layanan.syarat)
                }
            });
        }
    </script>
@endsection
