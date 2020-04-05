<?php

namespace App\DataTables\Rev;


use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

use Illuminate\Support\Str;

use App\Models\Blog\blog_posts;
use App\Models\Rev\rev_widgets;
use App\Models\Rev\rev_books;
use App\Models\Rev\rev_reviews;

class ExperiencesDataTable extends DataTable
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
			->addColumn('post', function ($resource) {
					$post = blog_posts::find($resource->post_id);
                    if(!isset($post)){
                        $title = "";
                    }
                    else
                    {
                        $title = $post->title;
                    }
					return $title;
				})
			->editColumn('product_id', function ($resource) {
					$product_id = Str::limit($resource->product_id,10);
					return $product_id;
				})
			->addColumn('action', function ($id) {
				$check_book = false;
				$check_review = false;
				$post = blog_posts::find($id->post_id);
				
				$rev_books = rev_books::where('post_id',$post->id)->get();
				if(count($rev_books))
				{
					$check_book = true;
				}
				$rev_reviews = rev_reviews::where('post_id',$post->id)->get();
				if(count($rev_reviews))
				{
					$check_review = true;
				}
				
				if(!$check_book || !$check_review)
				{
					return '<div class="btn-toolbar justify-content-end"><div class="btn-group mr-2 mb-2" role="group"><button id="btn-edit" type="button" onClick="EDIT(\''.$id->id.'\'); return false;" class="btn btn-success"><i class="fa fa-edit"></i> Edit</button><button id="btn-del" type="button" onClick="DELETE(\''. $id->id .'\')" class="btn btn-danger"><i class="fa fa-trash-alt"></i> Delete</button></div><div class="btn-group mb-2" role="group"></div></div>';
				}
				else
				{
					return '<div class="btn-toolbar justify-content-end"><div class="btn-group mr-2 mb-2" role="group"><button id="btn-edit" type="button" onClick="EDIT(\''.$id->id.'\'); return false;" class="btn btn-success"><i class="fa fa-edit"></i> Edit</button><button id="btn-del" type="button"  class="btn btn-light" disabled="true"><i class="fa fa-trash-alt"></i> Delete</button></div><div class="btn-group mb-2" role="group"></div></div>';
				}
            })
			->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Rev/ExperiencesDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(rev_widgets $model)
    {
        $query = rev_widgets::get();
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
			["name" => "post", "title" => "post", "data" => "post"],
			["name" => "product_id", "title" => "product_id", "data" => "product_id"],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Rev/Experiences_' . date('YmdHis');
    }
}
