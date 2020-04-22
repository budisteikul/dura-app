<?php

namespace App\Mail\Rev;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\Rev\rev_shoppingcarts;
use App\Models\Rev\rev_shoppingcart_products;
use PDF;

class Booking extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		$rev_shoppingcarts = rev_shoppingcarts::where('id',$this->id)->where('bookingStatus','CONFIRMED')->first();
		$invoice = PDF::loadView('components.vertikaltrip.invoice-pdf', compact('rev_shoppingcarts'))->setPaper('a4', 'portrait');
		
		$mail = $this->view('layouts.mail.booking-tour')
                    ->text('layouts.mail.booking-tour_plain')
				    ->subject('Booking Confirmation')
					->with('rev_shoppingcarts',$rev_shoppingcarts)
					->attachData($invoice->output(), 'Invoice-'. $rev_shoppingcarts->confirmationCode .'.pdf', ['mime' => 'application/pdf']);
					
		foreach($rev_shoppingcarts->shoppingcart_products()->get() as $rev_shoppingcart_products)
		{
			$customPaper = array(0,0,300,540);
			$ticket = PDF::loadView('components.vertikaltrip.ticket-pdf', compact('rev_shoppingcart_products'))->setPaper($customPaper);
			$mail->attachData($ticket->output(), 'Ticket-'. $rev_shoppingcart_products->productConfirmationCode .'.pdf', ['mime' => 'application/pdf']);
		}
		return $mail ;
    }
}
