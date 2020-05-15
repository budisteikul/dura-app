<?php
namespace App\Classes\Rev;
use App\Models\Rev\rev_experiences;
use Illuminate\Support\Str;

class RevClass {
	
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