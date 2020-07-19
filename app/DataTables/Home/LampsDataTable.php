<?php

namespace App\DataTables\Home;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Models\Home\home_lamps;

class LampsDataTable extends DataTable
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
            ->editColumn('name', function($id){
                return $id->name .'<br /><small>'. $id->ip .'</small>';
            })
            ->editColumn('state', function($id){
                if($id->state=="1")
                {
                    return '<div class="btn-toolbar "><div class="btn-group mr-2 mb-2" role="group"><button id="btn-del" type="button" onClick="UPDATE(\''. $id->id .'\',\'0\')" class="btn btn-secondary"><i class="fa fa-toggle-off"></i> OFF</button></div><div class="btn-group mb-2" role="group"></div></div>';
                }
                else
                {
                    return '<div class="btn-toolbar "><div class="btn-group mr-2 mb-2" role="group"><button id="btn-del" type="button" onClick="UPDATE(\''. $id->id .'\',\'1\')" class="btn btn-success"><i class="fa fa-toggle-on"></i> ON</button></div><div class="btn-group mb-2" role="group"></div></div>';
                }
            })
            ->addColumn('action', function ($id) {
                return '<div class="btn-toolbar justify-content-end"><div class="btn-group mr-2 mb-2" role="group"><button id="btn-del" type="button" onClick="DELETE(\''. $id->id .'\')" class="btn btn-danger"><i class="fa fa-trash-alt"></i> Delete</button></div><div class="btn-group mb-2" role="group"></div></div>';
            })
            ->rawColumns(['action','state','name']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Home/LampsDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(home_lamps $model)
    {
        return home_lamps::get();
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
            ["name" => "name", "title" => "Name", "data" => "name", 'width' => '100px'],
            ["name" => "state", "title" => "State", "data" => "state",'searchable' => false]
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Home/Lamps_' . date('YmdHis');
    }
}
