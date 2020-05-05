<?php

namespace App\Http\Controllers\Rev;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\DataTables\Rev\BookingsDataTable;
use App\Models\Rev\rev_shoppingcarts;
use App\Classes\Rev\BookClass;
use App\Classes\Rev\PaypalClass;

class BookingController extends Controller
{
    public function index(BookingsDataTable $dataTable)
    {
        return $dataTable->render('rev.booking.index');
    }
	
	public function update(Request $request, $id)
    {
		if($request->input('update')!="")
		{
			$validator = Validator::make($request->all(), [
          			'update' => 'in:capture,void'
       		]);
				
			if ($validator->fails()) {
            	$errors = $validator->errors();
				return response()->json($errors);
       		}
				
			$rev_shoppingcarts = rev_shoppingcarts::find($id);
			$update = $request->input('update');
			if($update=="capture")
			{
				PaypalClass::captureAuth($rev_shoppingcarts->authorizationID);
				$rev_shoppingcarts->paymentStatus = 2;
				$rev_shoppingcarts->bookingStatus = 'CONFIRMED';
				$rev_shoppingcarts->save();
			}
			if($update=="void")
			{
				PaypalClass::voidPaypal($rev_shoppingcarts->authorizationID);
				$rev_shoppingcarts->paymentStatus = 3;
				$rev_shoppingcarts->bookingStatus = 'CANCELLED';
				$rev_shoppingcarts->save();
			}
			
			
			return response()->json([
					"id"=>"1",
					"message"=>'success'
					]);
		}
	}
	
	public function destroy($id)
    {
        rev_shoppingcarts::find($id)->delete();
    }
}
