<?php

namespace App\DataTables\Rev;

use App\Models\Rev\rev_shoppingcarts;
use Yajra\DataTables\Services\DataTable;
use App\Classes\Rev\BookClass;

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
			->addColumn('travelDate', function ($rev_shoppingcarts) {
				return BookClass::texttodate($rev_shoppingcarts->shoppingcart_products()->first()->date);
			})
			->addColumn('booking', function ($rev_shoppingcarts) {
				$confirmationCode = $rev_shoppingcarts->confirmationCode;
				$name = $rev_shoppingcarts->shoppingcart_questions()->select('answer')->where('type','mainContactDetails')->where('questionId','firstName')->first()->answer .' '. $rev_shoppingcarts->shoppingcart_questions()->select('answer')->where('type','mainContactDetails')->where('questionId','lastName')->first()->answer;
				$traveller = 0;
				foreach($rev_shoppingcarts->shoppingcart_products()->get() as $shoppingcart_products)
				{
					foreach($shoppingcart_products->shoppingcart_rates()->where('type','product')->get() as $shoppingcart_rates)
					{
						$traveller += $shoppingcart_rates->qty;
					}
				}
				
				$email = $rev_shoppingcarts->shoppingcart_questions()->select('answer')->where('type','mainContactDetails')->where('questionId','email')->first()->answer;
				$date = $rev_shoppingcarts->shoppingcart_products()->first()->date;
				$channel = $rev_shoppingcarts->bookingChannel;
				$product = $rev_shoppingcarts->shoppingcart_products()->first()->title;
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
				
				$note = '';
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
				if($note!="") $note = "----". $note;
				
				$content = '<a href="/pdf/invoice/'.$rev_shoppingcarts->id.'">'. $confirmationCode .'</a><br>';
				$content .= 'Channel : '. $channel .'<br>';
				$content .= 'Name : '. $name .'<br>';
				$content .= 'Traveller : '. $traveller .'<br>';
				$content .= 'Email : '. $email .'<br>';
				$content .= 'Product : '. $product .'<br>';
				$content .= 'Date : '. $date .'<br>';
				$content .= 'Payment Status : '. $paymentStatus .'<br>';
				$content .= 'Booking Status : '. $status .'<br>';
				$content .= $note .'<br>';
				
				return $content;
			})
			->addColumn('action', function ($id) {
				
				if($id->paymentStatus==1)
				{
					$button = '<div class="btn-toolbar justify-content-end"><div class="btn-group mb-2" role="group"><button onClick="STATUS(\''.$id->id.'\',\'capture\')" id="capture-'.$id->id.'" type="button" class="btn btn-primary"><i class="far fa-money-bill-alt"></i> Capture</button><button onClick="STATUS(\''.$id->id.'\',\'void\')" id="void-'.$id->id.'" type="button" class="btn btn-secondary"><i class="far fa-money-bill-alt"></i> Void</button></div></div>';
				}
				else
				{
					$button = '<div class="btn-toolbar justify-content-end"><div class="btn-group mr-2 mb-2" role="group"><button id="btn-del" type="button" onClick="DELETE(\''. $id->id .'\')" class="btn btn-danger"><i class="fa fa-trash-alt"></i> Delete</button></div><div class="btn-group mb-2" role="group"></div></div>';
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
						'order' => [3,'desc']
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
			["name" => "booking", "title" => "Booking", "data" => "booking"],
			["name" => "travelDate", "title" => "Date", "data" => "travelDate"],
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
