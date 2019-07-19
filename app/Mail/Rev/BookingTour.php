<?php

namespace App\Mail\Rev;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\Rev\rev_books;
use App\Models\Blog\blog_posts;
use Carbon\Carbon;

class BookingTour extends Mailable
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
		$rev_books = rev_books::find($this->id);
		$blog_posts = blog_posts::find($rev_books->post_id);
		
        return $this->view('layouts.mail.booking-tour')
                    ->text('layouts.mail.booking-tour_plain')
					->from('guide@vertikaltrip.com','Vertikal Trip Support')
				    ->subject('Thank you for booking')
					->with('tour',$blog_posts->title)
					->with('name',$rev_books->name)
					->with('email',$rev_books->email)
					->with('phone',$rev_books->phone)
					->with('ticket',$rev_books->ticket)
					->with('date',Carbon::parse($rev_books->date)->formatLocalized('%d %b %Y %I:%M %p'))
					->with('os0',$rev_books->traveller);
    }
}
