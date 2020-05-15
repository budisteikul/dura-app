<?php
namespace App\Classes\Rev;
use App\Models\Rev\rev_experiences;
use App\Classes\Rev\BokunClass;
use Illuminate\Support\Str;

class RevClass {
	public static function infoProductUpdate($productId)
	{
		$rev_experiences = rev_experiences::where('productId',$productId)->first();
		if(!isset($rev_experiences))
		{
			$contents = BokunClass::get_product($productId);
			$title = $contents->title;
			$rev_experiences = new rev_experiences;
			$rev_experiences->title = $title;
			$rev_experiences->slug = self::makeSlug($title);
			$rev_experiences->productId = $productId;
			$rev_experiences->save();
		}
	}
	public static function makeSlug($string,$id="")
		{
			$string = Str::slug($string,"-");
			$cek = 1;
			$string_test = $string;
			$i = 2;
			while($cek==1)
			{
				if ($id=="")
				{
					$results = rev_experiences::where('slug',$string_test)->count();
				}
				else
				{
					$results = rev_experiences::where('slug',$string_test)->where('id','<>',$id)->count();
				}
				if($results==0)
				{
					$cek=0;	
				}
				else
				{
					$string_test = $string ."-". $i;
				}
				$i++;
			}
			return $string_test;
			
		}
}
?>