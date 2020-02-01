<?php
namespace App\Classes\Rev;
use App\Models\Rev\rev_books;
use App\Models\Rev\rev_widgets;
use Illuminate\Support\Str;

class BookClass {
	
	public static function get_id($product_id)
	{
		$id = '';
		$slug = rev_widgets::with('posts')->where('product_id',$product_id)->first();
		if(isset($slug))
		{
			$id = $slug->posts->id;	
		}
		return $id;
	}
	
	public static function get_slug($id)
	{
		$slug = rev_widgets::with('posts')->where('product_id',$id)->first();
		if(isset($slug))
		{
			$url = '/tour/'. $slug->posts->slug;	
		}
		else
		{
			$url = '/tour?activityId='.$id;	
		}
		return $url;
	}
	
	public static function texttodate($str){
		$text = $str;
		$text = explode('@',$text);
		if(isset($text[1]))
		{
			$date = \DateTime::createFromFormat('D d.M Y ', $text[0]);
			$time = \DateTime::createFromFormat(' H:i', $text[1]);
			$hasil = $date->format('Y-m-d') .' '. $time->format('H:i:00');
		}
		else
		{
			$date = \DateTime::createFromFormat('D d.M Y', $text[0]);
			print($date->format('Y-m-d'));
			$hasil = $date->format('Y-m-d') .' 00:00:00';
		}
		return $hasil;
	}
	
	public static function datetotext($str){
		$date = \DateTime::createFromFormat('Y-m-d H:i:s', $str);
		return $date->format('D d.M Y @ H:i');
	}
	
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
		if($type=='accessibility')
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