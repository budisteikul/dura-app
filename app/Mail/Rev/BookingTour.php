<?php

namespace App\Mail\Rev;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookingTour extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($tour, $name, $email, $phone, $date, $os0)
    {
        $this->tour = $tour;
		 $this->name = $name;
		  $this->email = $email;
		   $this->phone = $phone;
		    $this->date = $date;
			 $this->os0 = $os0;
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
				    ->subject('New booking from '.$this->name )
					->with('tour',$this->tour)
					->with('name',$this->name)
					->with('email',$this->email)
					->with('phone',$this->phone)
					->with('date',$this->date)
					->with('os0',$this->os0);
    }
}
