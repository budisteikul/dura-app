<?php

namespace App\DataTables\Home;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Models\Home\Relay;

class RelayDataTable extends DataTable
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
            ->addColumn('link', function($id){
                return $_SERVER['HTTP_HOST'].'/home/relay/toggle/'.$id->id .'/[on or off]';
            })
            ->editColumn('state', function($id){
                if($id->state=="off")
                {
                    $state_button = '<button id="btn-update" type="button" onClick="UPDATE(\''.$id->id.'\'); return false;" class="btn btn-light"><i class="fa fa-toggle-off fa-2x"></i> </button>';
                }
                else
                {
                    $state_button = '<button id="btn-update" type="button" onClick="UPDATE(\''.$id->id.'\'); return false;" class="btn btn-light"><i class="fa fa-toggle-on fa-2x"></i> </button>';
                }
                return $state_button;
            })
            ->addColumn('action', function ($id) {
                
                return '<div class="btn-toolbar justify-content-end"><div class="btn-group mr-2 mb-2" role="group"><button id="btn-edit" type="button" onClick="EDIT(\''.$id->id.'\'); return false;" class="btn btn-success"><i class="fa fa-edit"></i> Edit</button><button id="btn-del" type="button" onClick="DELETE(\''. $id->id .'\')" class="btn btn-danger"><i class="fa fa-trash-alt"></i> Delete</button></div><div class="btn-group mb-2" role="group"></div></div>';
            })
            ->rawColumns(['action','state']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Home/RelayDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Relay $model)
    {
        return Relay::get();
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
                    ->addAction(['title' => '','width' => '220px','class' => 'text-center'])
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
            ["name" => "name", "title" => "name", "data" => "name"],
            ["name" => "ip", "title" => "ip", "data" => "ip"],
            ["name" => "link", "title" => "link", "data" => "link"],
            ["name" => "state", "title" => "state", "data" => "state", 'width' => '220px'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Home/Relay_' . date('YmdHis');
    }
}
