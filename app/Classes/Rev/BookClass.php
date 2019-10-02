<?php
namespace App\Classes\Rev;
use App\Models\Rev\rev_books;
use Illuminate\Support\Str;

class BookClass {
	public static function ticket(){
		$cek = 1;
		while($cek==1)
			{
				$ticket = strtoupper('VT-'.Str::random(6));
				$results = rev_books::where('ticket',$ticket)->count();
				if($results==0)
				{
					$cek=0;	
				}
			}
		return $ticket;
	}
}
?>