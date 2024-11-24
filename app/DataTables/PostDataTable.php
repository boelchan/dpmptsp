<?php

namespace App\DataTables;

use App\Models\Post;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PostDataTable extends DataTable
{
    public function dataTable($query)
    {
        $dataTable = datatables()->eloquent($query)->addIndexColumn();

        if (! request()->search['value']) {
            $dataTable->filter(function ($query) {
                if ($judul = request()->judul) {
                    $query->where('judul', 'like', '%'.$judul.'%');
                }
                if ($kategori_id = request()->kategori_id) {
                    $query->where('kategori_id', $kategori_id);
                }
                switch (request()->status) {
                    case 'publish':
                        $query->where('publish', 'ya');
                        break;
                    case 'pending':
                        $query->where('publish', 'tidak');
                        break;
                    case 'beranda':
                        $query->where('tampil_banner', 'ya');
                        break;
                }
            });
        }

        return $dataTable->editColumn('publish_at', function ($query) {
            if ($query->publish == 'ya') {
                $status = ' <span class="badge bg-lime mb-1">Publish '.$query->publish_at_label.'</span> <br>';
                if ($query->tampil_banner == 'ya') {
                    $status .= '<span class="badge bg-info mb-1">Tampil di Banner</span> <br> ';
                }
                if ($query->add_to_submenu == 'ya') {
                    $status .= '<span class="badge bg-purple mb-1">Tampil di Sub Menu</span><br> ';
                }
                if ($query->set_welcome_message == 'ya') {
                    $status .= '<span class="badge bg-yellow mb-1">Tampil di awal buka website </span> ';
                }

                return $status;
            } else {
                return '<span class="badge bg-secondary">Pending</span>';
            }
        })
            ->editColumn('kategori', function ($query) {
                return $query->kategori->nama;
            })
            ->editColumn('action', function ($query) {
                return view('components.button.show', ['action' => route('post.show', [$query->id, 'uuid' => $query->uuid])]).
                    view('components.button.edit', ['action' => route('post.edit', [$query->id, 'uuid' => $query->uuid])]).
                    view('components.button.destroy', ['action' => route('post.destroy', [$query->id, 'uuid' => $query->uuid]), 'label' => $query->judul, 'target' => 'post-table']);
            })
            ->rawColumns(['publish_at', 'action'])
            ->orderColumn('publish_at', 'updated_at $1');
    }

    public function query(Post $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('post-table')
            ->columns($this->getColumns())
            ->orderBy(3, 'desc')
            ->ajax([
                'data' => 'function(d) { 
                    d.judul = $("#judul").val();
                    d.kategori_id = $("#kategori_id").val();
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
            Column::computed('kategori'),
            Column::make('judul'),
            Column::make('publish_at')->title('status'),
            Column::computed('action')->addClass('text-center'),
        ];
    }
}
