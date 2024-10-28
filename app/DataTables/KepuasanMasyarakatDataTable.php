<?php

namespace App\DataTables;

use App\Models\KepuasanMasyarakat;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class KepuasanMasyarakatDataTable extends DataTable
{
    public function dataTable($query)
    {
        $dataTable = datatables()->eloquent($query)->addIndexColumn();

        if (! request()->search['value']) {
            $dataTable->filter(function ($query) {
                if ($instansi_id = request()->instansi_id) {
                    $query->where('instansi_id', $instansi_id);
                }
                if ($nilai = request()->nilai) {
                    $query->where('nilai', $nilai);
                }
            });
        }

        return $dataTable
            ->editColumn('instansi_id', function ($query) {
                return $query->instansi->nama;
            })
            ->editColumn('layanan_id', function ($query) {
                return $query->layanan->nama;
            })
            ->editColumn('created_at', function ($query) {
                return tanggalJam($query->created_at);
            })
            ->editColumn('action', function ($query) {
                $btn = view('components.button.show', ['action' => route('kepuasan.show', [$query->id, 'uuid' => $query->uuid])]);

                return $btn;
            })
            ->rawColumns(['bobot', 'action']);
    }

    public function query(KepuasanMasyarakat $model)
    {
        $q = $model->newQuery();
        if (auth()->user()->hasRole('instansi')) {
            $q = $q->where('instansi_id', auth()->user()->instansi_id);
        }

        return $q;
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('kepuasan-table')
            ->columns($this->getColumns())
            ->orderBy(1, 'desc')
            ->ajax([
                'data' => 'function(d) { 
                    d.instansi_id = $("#instansi_id").val();
                    d.nilai = $("#nilai").val();
                }',
            ])
            ->drawCallback("function( settings ) { $(document).find('[data-toggle=\"tooltip\"]').tooltip(); }")
            ->buttons('reset')
            ->dom('<"d-flex justify-content-between p-2 pt-3" row <"col-lg-6 d-flex"f> <"col-lg-6 d-flex justify-content-end px-2"B> >t <"d-flex justify-content-between m-2 row" <"col-md-6 d-flex justify-content-center justify-content-md-start"li> <"col-md-6 px-0"p> >');
    }

    protected function getColumns()
    {
        return [
            Column::computed('id')->title('no')->data('DT_RowIndex'),
            Column::make('created_at')->title('tanggal'),
            Column::make('instansi_id')->title('instansi'),
            Column::make('layanan_id')->title('layanan'),
            Column::make('ulasan'),
            Column::computed('action')->addClass('text-center'),
        ];
    }
}
