<?php
namespace App\Classes\Rev;
use App\Models\Rev\rev_books;
use Illuminate\Support\Str;

class BookClass {
	public static function lang($type,$str){
		$hasil = '';
		if($type=='categories')
		{
			$hasil = str_ireplace("_"," ",ucwords(strtolower($str)));
			
		}
		if($type=='dificulty')
		{
			$hasil = str_ireplace("_"," ",ucwords(strtolower($str)));
			
		}
		if($type=='type')
		{
			switch($str)
			{
				case 'ACTIVITIES':
					$hasil = 'Day tour/Activity';
				break;
			}
			
		}
		if($type=='language')
		{
			switch($str)
			{
				case 'ja':
					$hasil = 'Japanese';
				break;
				case 'ja':
					$hasil = 'Italian';
				break;
				case 'fr':
					$hasil = 'French';
				break;
				case 'en':
					$hasil = 'English';
				break;
			}
			
		}
		return $hasil;
	}
}
?>