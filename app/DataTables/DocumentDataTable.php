<?php

namespace App\DataTables;

use App\Models\Document;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class DocumentDataTable extends DataTable
{
    public function dataTable($query)
    {
        $dataTable = datatables()->eloquent($query)->addIndexColumn();

        if (! request()->search['value']) {
            $dataTable->filter(function ($query) {
                if ($title = request()->title) {
                    $query->where('title', 'like', '%'.$title.'%');
                }
                if ($document_category_id = request()->document_category_id) {
                    $query->where('document_category_id', 'like', '%'.$document_category_id.'%');
                }
                switch (request()->status) {
                    case 'publish':
                        $query->where('publish', 'ya');
                        break;
                    case 'pending':
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
            ->editColumn('document_category_id', function ($query) {
                return $query->kategori->nama;
            })
            ->editColumn('file', function ($query) {
                return '<a href="'.$query->url_berkas.'" target="_blank">Lihat <i class="ti ti-external-link"></i></a>';
            })
            ->editColumn('action', function ($query) {
                return view('components.button.show', ['action' => route('document.show', [$query->id, 'uuid' => $query->uuid])]).
                    view('components.button.edit', ['action' => route('document.edit', [$query->id, 'uuid' => $query->uuid])]).
                    view('components.button.destroy', ['action' => route('document.destroy', [$query->id, 'uuid' => $query->uuid]), 'label' => $query->nama, 'target' => 'document-table']);
            })
            ->rawColumns(['publish', 'action', 'file']);
    }

    public function query(Document $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('document-table')
            ->columns($this->getColumns())
            ->orderBy(1, 'asc')
            ->ajax([
                'data' => 'function(d) { 
                    d.title = $("#title").val();
                    d.document_category_id = $("#document_category_id").val();
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
            Column::make('document_category_id')->title('kategori'),
            Column::make('title')->title('dokumen'),
            Column::make('file'),
            Column::make('publish')->title('status'),
            Column::computed('action')->addClass('text-center'),
        ];
    }
}
