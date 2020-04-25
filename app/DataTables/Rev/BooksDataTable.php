<?php

namespace App\DataTables\Rev;
use Yajra\DataTables\Services\DataTable;

use App\Models\Rev\rev_books;
use App\Models\Rev\rev_resellers;
use App\Models\Blog\blog_posts;
use App\Models\Rev\rev_shoppingcarts;
use Carbon\Carbon;

class BooksDataTable extends DataTable
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
				->editColumn('date', function ($book) {
					$dateint = str_ireplace("-","",$book->date);
					$dateint = str_ireplace(":","",$dateint);
					$dateint = str_ireplace(" ","",$dateint);
					
					$st1 = date('YmdHis');
					$st2 = $dateint;
					$date = Carbon::parse($book->date)->formatLocalized('%d %b %Y %I:%M %p');
					if($st2 >= $st1)
					{
						return '<span class="badge badge-danger">'. $date .'</span>';
					}
					else
					{
						return '<span class="badge badge-success">'. $date .'</span>';
					}
				})
				
				->addColumn('booking', function ($book) {
					
					$ticket = '';
					$name = '';
					$phone = '';
					$email = '';
					$date_text = '';
					$traveller = '<strong>People :</strong> '. $book->traveller .'<br>';
					$channel = '';
					$product = '';
					$status = '';
					$note = '';
					
					if($book->ticket!='')
					{
						$check_ticket = rev_shoppingcarts::where('confirmationCode',$book->ticket)->first();
						if(isset($check_ticket))
						{
							$ticket = '<a href="/pdf/invoice/'. $check_ticket->id .'" target="_blank">'. $book->ticket .'</a><br>';
						}
						else
						{
							$ticket = $book->ticket .'<br>';
						}
					}
					if($book->name!='') $name = '<strong>Name :</strong> '. $book->name .'<br>';
					if($book->phone!='') $phone = '<strong>Phone :</strong> '.$book->phone .'<br>';
					if($book->email!='') $email = '<strong>Email :</strong> '.$book->email .'<br>';
					if($book->date_text!='') $date_text = '<strong>Date :</strong> '.$book->date_text .'<br>';
					
					$rev_resellers = rev_resellers::find($book->source);
					if(isset($rev_resellers)) $channel = '<strong>Channel :</strong> '. $rev_resellers->name .'<br>';
					
					$post = blog_posts::find($book->post_id);
					if(isset($post)) $product = '<strong>Product :</strong> '. $post->title .'<br>';
					
					if($book->status==1) $status = '<strong>Status :</strong> <span class="text-warning"><strong>PENDING</strong></span><br>';
					if($book->status==2) $status = '<strong>Status :</strong> <span class="text-success"><strong>CONFIRMED</strong></span><br>';
					if($book->status==3) $status = '<strong>Status :</strong> <span class="text-danger"><strong>CANCELLED</strong></span><br>';
					
					if(isset($book->ticket))
					{
					$rev_shoppingcarts = rev_shoppingcarts::where('confirmationCode',$book->ticket)->first();
					if(isset($rev_shoppingcarts))
					{
						$pickup_questions = $rev_shoppingcarts->shoppingcart_questions()->where('type','pickupQuestions')->orderBy('order')->get();
						$activityBookings = $rev_shoppingcarts->shoppingcart_questions()->where('type','activityBookings')->orderBy('order')->get();
						if(count($pickup_questions))
						{
							foreach($pickup_questions as $pickup_question)
							{
								$note .= '<br>'. $pickup_question->label .' : '. $pickup_question->answer;
							}
						}
						
						if(count($activityBookings))
						{
							foreach($activityBookings as $activityBooking)
							{
								$note .= '<br>'. $activityBooking->label .' : '. $activityBooking->answer;
							}
						}
						
					}
					}
					if($note!="") $note = "----". $note;
					
					$return = $ticket . $name . $traveller . $phone . $email . $date_text . $channel . $product . $status . $note;
					return   '<div>'. $return .'</div>';
				})
				->addColumn('action', function ($book) {
					
						$button = '';
						if($book->status==1)
						{
							$check_ticket = rev_shoppingcarts::where('confirmationCode',$book->ticket)->first();
							if(isset($check_ticket))
							{
								return '<div class="btn-toolbar justify-content-end"><div class="btn-group mb-2" role="group"><button onClick="STATUS(\''.$book->id.'\',\'capture\')" id="capture-'.$book->id.'" type="button" class="btn btn-primary"><i class="far fa-money-bill-alt"></i> Capture</button><button onClick="STATUS(\''.$book->id.'\',\'void\')" id="void-'.$book->id.'" type="button" class="btn btn-secondary"><i class="far fa-money-bill-alt"></i> Void</button></div></div>';
							}
							else
							{
								return '<div class="btn-toolbar justify-content-end">
									<div class="btn-group mr-2 mb-2" role="group"><button id="btn-edit" type="button" onClick="EDIT(\''.$book->id.'\'); return false;" class="btn btn-success"><i class="fa fa-edit"></i> Edit</button><button id="btn-del" type="button" onClick="DELETE(\''. $book->id .'\')" class="btn btn-danger"><i class="fa fa-trash-alt"></i> Delete</button></div>
									</div>';
							}
						}
						else
						{
							return '<div class="btn-toolbar justify-content-end">
									<div class="btn-group mr-2 mb-2" role="group"><button id="btn-edit" type="button" onClick="EDIT(\''.$book->id.'\'); return false;" class="btn btn-success"><i class="fa fa-edit"></i> Edit</button><button id="btn-del" type="button" onClick="DELETE(\''. $book->id .'\')" class="btn btn-danger"><i class="fa fa-trash-alt"></i> Delete</button></div>
									</div>';
						}
						
						
					
				})->rawColumns(['action','booking','date','status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Rev/BooksDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(rev_books $model)
    {
        return $model->query();
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
						'order' => [2,'desc']
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
            ["name" => "DT_RowIndex", "title" => "No", "data" => "DT_RowIndex", "orderable" => false, "render" => null,'searchable' => false, 'width' => '30px'],
			["name" => "booking", "title" => "booking", "data" => "booking", "orderable" => false],
			["name" => "date", "title" => "date", "data" => "date"],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Rev/Books_' . date('YmdHis');
    }
}
