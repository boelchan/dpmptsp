<?php

namespace App\DataTables;

use App\Enum\StatusPengaduanEnum;
use App\Models\Pengaduan;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PengaduanDataTable extends DataTable
{
    public function dataTable($query)
    {
        $dataTable = datatables()->eloquent($query)->addIndexColumn();

        if (! request()->search['value']) {
            $dataTable->filter(function ($query) {
                if ($instansi_id = request()->instansi_id) {
                    $query->where('instansi_id', $instansi_id);
                }
                if ($status = request()->status) {
                    $query->where('status', $status);
                }
            });
        }

        return $dataTable->editColumn('status', function ($query) {
            return StatusPengaduanEnum::label($query->status);
        })
            ->editColumn('created_at', function ($query) {
                return tanggalJam($query->created_at);
            })
            ->editColumn('validasi_at', function ($query) {
                return tanggalJam($query->validasi_at);
            })
            ->editColumn('tanggapan_at', function ($query) {
                return tanggalJam($query->tanggapan_at);
            })
            ->editColumn('action', function ($query) {
                $btn = view('components.button.show', ['action' => route('pengaduan.show', [$query->id, 'uuid' => $query->uuid])]);

                if (auth()->user()->hasRole('superadmin')) {
                    $btn .= view('components.button.destroy', ['action' => route('pengaduan.destroy', [$query->id, 'uuid' => $query->uuid]), 'label' => $query->name, 'target' => 'pengaduan-table']);
                }

                return $btn;
            })
            ->rawColumns(['action']);
    }

    public function query(Pengaduan $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('pengaduan-table')
            ->columns($this->getColumns())
            ->orderBy(4, 'desc')
            ->ajax([
                'data' => 'function(d) { 
                    d.status = $("#status").val();
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
            Column::make('nama_pemohon'),
            Column::make('status'),
            Column::make('created_at')->title('tanggal pengaduan'),
            Column::make('validasi_at')->title('tanggal validasi'),
            Column::make('tanggapan_at')->title('tanggal ditanggapi'),
            Column::computed('action')->addClass('text-center'),
        ];
    }
}
