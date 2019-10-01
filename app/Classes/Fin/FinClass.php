<?php
namespace App\Classes\Fin;

use App\Models\Fin\fin_transactions;
use App\Models\Fin\fin_categories;

class FinClass {

	public static function total_per_month($category_id,$year,$month){
			$total = fin_transactions::where('category_id',$category_id)->whereYear('date',$year)->whereMonth('date',$month)->sum('amount');
			
		return $total;
	}
}
?>