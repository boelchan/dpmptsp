<div class="col-lg-4 col-md-12 col-sm-12 col-12 mt_md-60 mt_sm-60">
    <div class="sidebar-wrapper boxed-sidebar rounded">
        <div class="widget-area widget-category clearfix" id="pencarian">
            <div class="widget-area widget-search clearfix p-0">
                <h2 class="widget-title fw-normal"> Pencarian </h2>
                <div class="search-form">
                    <form action="{{ route('cari') }}" method="get">
                        <div class="form-group">
                            <input type="text" maxlength="200" name="search" class="form-control" placeholder="cari layanan apa ? KTP, perizinan">
                            <button type="submit" class="submit-search" aria-label="Search"><i class="ti ti-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="category-area">
                @php
                    $banner = setting('sidebar');
                @endphp
                @foreach ($navbarMenu['addToSidebar'] as $menu)
                    <div class="category mb-30" data-overlay="5">
                        <figure class="category-image" data-bg-image="{{ $banner }}">
                            <img src="{{ $banner }}" alt="Category Box">
                        </figure>
                        <h5 class="mb-0 fw-normal"><a href="{{ $menu->url }}">{{ $menu->nama }}</a></h5>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
