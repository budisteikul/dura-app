<?php

namespace App\DataTables\Rev;

use App\Models\Rev\rev_resellers;
use Yajra\DataTables\Services\DataTable;
use App\Models\Rev\rev_books;
use App\Models\Rev\rev_reviews;

class ResellersDataTable extends DataTable
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
				$check_book = false;
				$check_review = false;
				
				$rev_books = rev_books::where('source',$id->id)->get();
				if(count($rev_books))
				{
					$check_book = true;
				}
				$rev_reviews = rev_reviews::where('source',$id->id)->get();
				if(count($rev_reviews))
				{
					$check_review = true;
				}
				
					if($id->status==1)
						{
							$label = ""	;
							$status = 0;
							$button = "btn-secondary";
							$icon = "fa-toggle-on";
							$text = " ";
							$disabled = "";
						}
						else
						{
							$label = ""	;
							$status = 1;
							$button = "btn-light";
							$icon = "fa-toggle-off";
							$text = " ";
							$disabled = "";
						}
						
				if($check_book || $check_review)
				{
					return '<div class="btn-toolbar justify-content-end">
						
						<div class="btn-group mb-2" role="group"><button id="btn-update" type="button" onClick="STATUS(\''. $id->id .'\',\''. $status .'\')" class="btn '.$button.'"><i class="fa '. $icon .'"></i>'. $text .'</button></div>
						&nbsp;
						<div class="btn-group mr-2 mb-2" role="group"><button id="btn-edit" type="button" onClick="EDIT(\''.$id->id.'\'); return false;" class="btn btn-success"><i class="fa fa-edit"></i> Edit</button></div>
						
						</div>';
				}
				else
				{
				//==============================================================================
						
					return '<div class="btn-toolbar justify-content-end">
						
						<div class="btn-group mb-2" role="group"><button id="btn-update" type="button" onClick="STATUS(\''. $id->id .'\',\''. $status .'\')" class="btn '.$button.'"><i class="fa '. $icon .'"></i>'. $text .'</button></div>
						&nbsp;
						<div class="btn-group mr-2 mb-2" role="group"><button id="btn-edit" type="button" onClick="EDIT(\''.$id->id.'\'); return false;" class="btn btn-success"><i class="fa fa-edit"></i> Edit</button><button id="btn-del" type="button" onClick="DELETE(\''. $id->id .'\')" class="btn btn-danger"><i class="fa fa-trash-alt"></i> Delete</button></div>
						
						</div>';
				//====================================================
				}
            })
			->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Rev/ResellersDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(rev_resellers $model)
    {
		$query = rev_resellers::get();
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
			["name" => "name", "title" => "Name", "data" => "name"],
			["name" => "id", "title" => "Channel UUID", "data" => "id"],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Rev/Resellers_' . date('YmdHis');
    }
}
