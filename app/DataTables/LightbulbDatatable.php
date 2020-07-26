<?php

namespace App\DataTables;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Models\settings;

class LightbulbDatatable extends DataTable
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
            ->addColumn('action', function ($id) {
                if($id->value=="off")
                {
                    return '<button id="btn-edit" type="button" onClick="TOGGLE(); return false;" class="btn btn-block btn-danger">OFF</button>';
                }
                else
                {
                    return '<button id="btn-edit" type="button" onClick="TOGGLE(); return false;" class="btn btn-block btn-success">ON</button>';
                }
                
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\LightbulbDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(settings $model)
    {
        return settings::where('name','lightbulb')->get();
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
                        'dom' => 'tr',
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
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Lightbulb_' . date('YmdHis');
    }
}
