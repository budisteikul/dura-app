<?php
namespace App\Classes\Rev;
use App\Models\Rev\rev_books;

class BookClass {
	public static function ticket(){
		$cek = 1;
		while($cek==1)
			{
				$ticket = strtoupper('VT'.str_random(6));
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