<?php

namespace App\DataTables;

use App\Models\Pegawai;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PegawaiDataTable extends DataTable
{
    public function dataTable($query)
    {
        $dataTable = datatables()->eloquent($query)->addIndexColumn();

        if (! request()->search['value']) {
            $dataTable->filter(function ($query) {
                if ($nama = request()->nama) {
                    $query->where('nama', 'like', '%'.$nama.'%');
                }
            });
        }

        return $dataTable
            ->editColumn('bidang_id', function ($query) {
                return $query->bidang->nama;
            })
            ->editColumn('nama', function ($query) {
                return $query->nama.($query->is_leader == 'ya' ? ' <span class="badge bg-lime">Kepala Bidang</span>' : '');
            })
            ->editColumn('action', function ($query) {
                return view('components.button.show', ['action' => route('pegawai.show', [$query->id, 'uuid' => $query->uuid])]).
                    view('components.button.edit', ['action' => route('pegawai.edit', [$query->id, 'uuid' => $query->uuid])]).
                    view('components.button.destroy', ['action' => route('pegawai.destroy', [$query->id, 'uuid' => $query->uuid]), 'label' => $query->nama, 'target' => 'link-table']);
            })
            ->rawColumns(['publish', 'action', 'nama']);
    }

    public function query(Pegawai $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('link-table')
            ->columns($this->getColumns())
            ->orderBy(1, 'asc')
            ->ajax([
                'data' => 'function(d) { 
                    d.nama = $("#nama").val();
                }',
            ])
            ->drawCallback("function( settings ) { $(document).find('[data-toggle=\"tooltip\"]').tooltip(); }")
            ->buttons('create')
            ->dom('<"d-flex justify-content-between p-2 pt-3" row <"col-lg-6 d-flex"f> <"col-lg-6 d-flex justify-content-end px-2"B> >t <"d-flex justify-content-between m-2 row" <"col-md-6 d-flex justify-content-center justify-content-md-start"li> <"col-md-6 px-0"p> >');
    }

    protected function getColumns()
    {
        return [
            Column::computed('id')->title('no')->data('DT_RowIndex'),
            Column::make('bidang_id')->title('bidang'),
            Column::make('nama'),
            Column::make('jabatan'),
            Column::computed('action')->addClass('text-center'),
        ];
    }
}
