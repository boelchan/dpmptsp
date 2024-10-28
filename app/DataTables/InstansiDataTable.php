<?php

namespace App\DataTables;

use App\Models\Instansi;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class InstansiDataTable extends DataTable
{
    public function dataTable($query)
    {
        $dataTable = datatables()->eloquent($query)->addIndexColumn();

        if (! request()->search['value']) {
            $dataTable->filter(function ($query) {
                if ($nama = request()->nama) {
                    $query->where('nama', 'like', '%'.$nama.'%');
                }
                switch (request()->status) {
                    case 'ya':
                        $query->where('publish', 'ya');
                        break;
                    case 'tidak':
                        $query->where('publish', 'tidak');
                        break;
                }
            });
        }

        return $dataTable->editColumn('publish', function ($query) {
            if ($query->publish == 'ya') {
                return '<span class="badge bg-lime mb-1">Publish</span> ';
            } else {
                return '<span class="badge bg-secondary">Pending</span>';
            }
        })
            ->editColumn('action', function ($query) {
                $btn = view('components.button.show', ['action' => route('instansi.show', [$query->id, 'uuid' => $query->uuid])]);
                if (auth()->user()->hasRole('superadmin')) {
                    $btn .= view('components.button.edit', ['action' => route('instansi.edit', [$query->id, 'uuid' => $query->uuid])]).
                        view('components.button.destroy', ['action' => route('instansi.destroy', [$query->id, 'uuid' => $query->uuid]), 'label' => $query->nama, 'target' => 'instansi-table']);
                }

                return $btn;
            })
            ->rawColumns(['publish', 'action']);
    }

    public function query(Instansi $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('instansi-table')
            ->columns($this->getColumns())
            ->orderBy(1, 'asc')
            ->ajax([
                'data' => 'function(d) { 
                    d.nama = $("#nama").val();
                    d.status = $("#status").val();
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
            Column::make('nama'),
            Column::make('publish')->title('status'),
            Column::computed('action')->addClass('text-center'),
        ];
    }
}
