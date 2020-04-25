<?php

namespace App\DataTables\Rev\Backend;
use App\Models\Rev\rev_shoppingcarts;
use Yajra\DataTables\Services\DataTable;

class ShoppingCartsDataTable extends DataTable
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
			->addColumn('action', function ($id) {
				return '<div class="btn-toolbar justify-content-end"><div class="btn-group mr-2 mb-2" role="group"><button id="btn-del" type="button" onClick="DELETE(\''. $id->id .'\')" class="btn btn-danger"><i class="fa fa-trash-alt"></i> Delete</button></div><div class="btn-group mb-2" role="group"></div></div>';
				
            })
			->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Rev/Backend/ShoppingCartsDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(rev_shoppingcarts $model)
    {
        $query = rev_shoppingcarts::get();
        return $query;
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
			["name" => "created_at", "title" => "created_at", "data" => "created_at"],
			["name" => "sessionId", "title" => "sessionId", "data" => "sessionId"],
			["name" => "bookingStatus", "title" => "bookingStatus", "data" => "bookingStatus"],
			["name" => "confirmationCode", "title" => "confirmationCode", "data" => "confirmationCode"],
			
			
			["name" => "subtotal", "title" => "subtotal", "data" => "subtotal"],
			["name" => "discount", "title" => "discount", "data" => "discount"],
			["name" => "total", "title" => "total", "data" => "total"],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Rev/Backend/ShoppingCarts_' . date('YmdHis');
    }
}
