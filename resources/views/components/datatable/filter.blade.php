{{-- <div class="collapse mb-2 {{ $collapsed }}" id="collapse-datatable-filter"> --}}
<div class="collapse mb-2" id="collapse-datatable-filter">
    <div class="card shadow-sm">
        <div class="card-header p-0">
            <h3 class="card-title px-3 py-2">Pencarian</h3>
            <div class="card-actions pe-3">
                <button class="submit-filter btn btn-outline-primary p-1" type="submit" data-target="{{ $target }}"><i class="ti ti-search fs-3 me-1"></i> Cari</button>
                <button class="submit-filter btn btn-outline-warning p-1" data-target="{{ $target }}" value="reset"><i class="ti ti-reload fs-3 me-1"></i> Reset</button>
                <button class="btn p-1 border-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-datatable-filter" aria-expanded="false" aria-controls="collapse-datatable-filter"> <i class="ti ti-chevron-down fs-2 fw-bold"></i> </button>
            </div>
        </div>
        <div class="card-body filter-datatable-form d-flex flex-sm-row py-2">
            <div class="row col-12">
                {!! $slot !!}
            </div>
        </div>
    </div>
</div>
