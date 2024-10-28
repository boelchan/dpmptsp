<?php

namespace App\DataTables;

use App\Models\Category;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CategoryDataTable extends DataTable
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

        return $dataTable->editColumn('action', function ($query) {
            if (! $query->is_primary) {
                return view('components.button.edit', ['action' => route('category.edit', $query->id)]).
                view('components.button.destroy', ['action' => route('category.destroy', $query->id), 'label' => $query->nama, 'target' => 'category-table']);
            }
        });
    }

    public function query(Category $model)
    {
        return $model->newQuery()->orderBy('is_primary', 'desc')->orderBy('nama', 'asc');
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('category-table')
            ->columns($this->getColumns())
            ->ordering(false)
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
            Column::computed('id')->title('no')->data('DT_RowIndex')->orderable(false),
            Column::make('nama')->orderable(false),
            Column::make('add_to_header_menu')->title('tampilkan di header menu'),
            Column::make('add_to_footer_menu')->title('tampilkan di footer menu'),
            Column::make('add_to_sidebar_menu')->title('tampilkan di sidebar menu'),
            Column::computed('action')->addClass('text-center'),
        ];
    }
}
