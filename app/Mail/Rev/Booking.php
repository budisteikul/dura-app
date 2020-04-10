<?php

namespace App\Mail\Rev;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\Rev\rev_shoppingcarts;

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
        $this->rev_shoppingcarts = rev_shoppingcarts::find($id);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		return $this->view('layouts.mail.booking-tour')
                    ->text('layouts.mail.booking-tour_plain')
				    ->subject('Booking Confirmation')
					->with('rev_shoppingcarts',$this->rev_shoppingcarts);
    }
}
