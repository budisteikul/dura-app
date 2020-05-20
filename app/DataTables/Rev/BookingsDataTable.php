<?php

namespace App\DataTables\Rev;

use App\Models\Rev\rev_shoppingcarts;
use Yajra\DataTables\Services\DataTable;
use App\Classes\Rev\BookClass;
use Carbon\Carbon;

class BookingsDataTable extends DataTable
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
			->addColumn('booking', function ($rev_shoppingcarts) {
				$confirmationCode = $rev_shoppingcarts->confirmationCode;
				$name = $rev_shoppingcarts->shoppingcart_questions()->select('answer')->where('type','mainContactDetails')->where('questionId','firstName')->first()->answer .' '. $rev_shoppingcarts->shoppingcart_questions()->select('answer')->where('type','mainContactDetails')->where('questionId','lastName')->first()->answer;
				
				$email = $rev_shoppingcarts->shoppingcart_questions()->select('answer')->where('type','mainContactDetails')->where('questionId','email')->first()->answer;
				$phone = $rev_shoppingcarts->shoppingcart_questions()->select('answer')->where('type','mainContactDetails')->where('questionId','phoneNumber')->first()->answer;
				
				$channel = $rev_shoppingcarts->bookingChannel;
				
				
				$status = $rev_shoppingcarts->bookingStatus;
				$paymentStatus = $rev_shoppingcarts->paymentStatus;
				switch($paymentStatus)
				{
					case 1:
						$paymentStatus = "AUTHORIZED";
					break;
					case 2:
						$paymentStatus = "CAPTURED";
					break;
					case 3:
						$paymentStatus = "VOIDED";
					break;
					default:
						$paymentStatus = "NOT AVAILABLE";
				}
				
				
				
				$content = '';
				
				if($confirmationCode!="") $content .= '<a href="/pdf/invoice/'.$rev_shoppingcarts->id.'">'. $confirmationCode .'</a><br>';
				if($channel!="") $content .= 'Channel : '. $channel .'<br>';
				if($name!="") $content .= 'Name : '. $name .'<br>';
				
				if($email!="") $content .= 'Email : '. $email .'<br>';
				if($phone!="") $content .= 'Phone : '. $phone .'<br>';
				$pickup_questions = $rev_shoppingcarts->shoppingcart_questions()->where('type','pickupQuestions')->orderBy('order')->get();
				if(count($pickup_questions))
						{
							foreach($pickup_questions as $pickup_question)
							{
								$content .= 'Pickup : '. $pickup_question->answer .'<br>';
							}
						}
				
				
				if($paymentStatus!="") $content .= 'Payment Status : '. $paymentStatus .'<br>';
				if($status!="") $content .= 'Booking Status : '. $status .'<br>';
				
				
				
				
				$product_content = '';
				foreach($rev_shoppingcarts->shoppingcart_products()->get() as $shoppingcart_products)
				{
					
					$product_content .= '<b>'. $shoppingcart_products->title .'</b><br>';
					if($shoppingcart_products->rate!="") $product_content .= ''. $shoppingcart_products->rate .'<br>';
					$product_content .= BookClass::datetotext($shoppingcart_products->date) .'<br>';
					foreach($shoppingcart_products->shoppingcart_rates()->get() as $shoppingcart_rates)
					{
						if($shoppingcart_rates->type=="product")
						{
							$product_content .= ''. $shoppingcart_rates->qty .' '. $shoppingcart_rates->unitPrice .'<br>';
						}
						elseif($shoppingcart_rates->type=="pickup")
						{
							$product_content .= ''. $shoppingcart_rates->title .'<br>';
						}
						
						
					}
					
					foreach($rev_shoppingcarts->shoppingcart_questions()->where('type','activityBookings')->where('bookingId',$shoppingcart_products->bookingId)->get() as $shoppingcart_questions)
					{
						$product_content .= $shoppingcart_questions->label .' : '. $shoppingcart_questions->answer .'<br>';
					}
					
					$product_content .= "<br>";
				}
				
				return ''. $content .'<br>'. $product_content ;
			})
			->addColumn('action', function ($id) {
				
				if($id->paymentStatus==1)
				{
					$button = '<div class="btn-toolbar justify-content-end"><div class="btn-group mb-2" role="group"><button onClick="STATUS(\''.$id->id.'\',\'capture\')" id="capture-'.$id->id.'" type="button" class="btn btn-primary"><i class="far fa-money-bill-alt"></i> Capture</button><button onClick="STATUS(\''.$id->id.'\',\'void\')" id="void-'.$id->id.'" type="button" class="btn btn-secondary"><i class="far fa-money-bill-alt"></i> Void</button></div></div>';
				}
				else
				{
					$cancelButton = '';
					if($id->bookingStatus=="CONFIRMED")
					{
						$cancelButton = '<button id="btn-cancel" type="button" onClick="CANCEL(\''. $id->id .'\')" class="btn btn-warning btn-sm"><i class="fa fa-ban"></i> Cancel this booking</button>';
					}
					
					$button = '<div class="btn-toolbar justify-content-end"><div class="btn-group mr-2 mb-2" role="group">
					'. $cancelButton .'
					<button id="btn-del" type="button" onClick="DELETE(\''. $id->id .'\')" class="btn btn-danger btn-sm"><i class="fa fa-trash-alt"></i></button>
					</div><div class="btn-group mb-2" role="group"></div></div>';
				}
				return $button;
				
            })
			->rawColumns(['action','booking']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Rev/BookingsDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(rev_shoppingcarts $model)
    {
        //$query = rev_shoppingcarts::get();
        //return $query;
		return $model->query()->where('bookingStatus','CONFIRMED')->orWhere('bookingStatus','CANCELLED');
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
			["name" => "booking", "title" => "Booking", "data" => "booking", "orderable" => false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Rev/Bookings_' . date('YmdHis');
    }
}
