<?php

namespace App\DataTables;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Models\Products;

class ProductDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
            return datatables($query)
                ->addIndexColumn()
                ->editColumn('price',function($id){
                    return  number_format($id->price,0,',','.');
                })
                ->addColumn('action', function ($id) {
                return '
                <div class="btn-toolbar justify-content-end">
                    <div class="btn-group mr-2 mb-2" role="group">
                        <a  id="btn-print" class="btn btn-primary" href="'.route('route_products.show', $id->id).'" target="_blank"><i class="fa fa-print"></i> Print</a>
                        <button id="btn-edit" type="button" onClick="EDIT(\''.$id->id.'\'); return false;" class="btn btn-success"><i class="fa fa-edit"></i> Ubah</button>
                        <button id="btn-del" type="button" onClick="DELETE(\''. $id->id .'\')" class="btn btn-danger"><i class="fa fa-trash-alt"></i> Hapus</button>
                    </div>
                </div>';
                })
                ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\ProductDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Products $model)
    {
        return Products::get();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->addAction(['title' => '','width' => '300px','class' => 'text-center'])
                    ->parameters([
                        'language' => [
                            'paginate' => [
                                'previous'=>'<i class="fa fa-step-backward"></i>',
                                'next'=>'<i class="fa fa-step-forward"></i>',
                                'first'=>'<i class="fa fa-fast-backward"></i>',
                                'last'=>'<i class="fa fa-fast-forward"></i>'
                                ]
                            ],
                        'pagingType' => 'full_numbers',
                        'responsive' => true,
                        'order' => [0,'desc']
                    ])
                    ->ajax('/'.request()->path());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            ["name" => "created_at", "title" => "created_at", "data" => "created_at", "orderable" => true, "visible" => false,'searchable' => false],
            ["name" => "DT_RowIndex", "title" => "No", "data" => "DT_RowIndex", "orderable" => false, "render" => null,'searchable' => false, 'width' => '30px'],
            ["name" => "sku", "title" => "SKU", "data" => "sku"],
            ["name" => "name", "title" => "Nama", "data" => "name"],
            ["name" => "price", "title" => "Harga", "data" => "price"],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Product_' . date('YmdHis');
    }
}