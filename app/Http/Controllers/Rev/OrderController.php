<?php

namespace App\Http\Controllers\Rev;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Models\Rev\rev_orders;
use Illuminate\Support\Facades\Validator;

use App\Mail\Rev\BookingTour;
use Illuminate\Support\Facades\Request as Http;
use DB;
use Mail;

class OrderController extends Controller
{
	
	
	public function order(Request $request)
    {
        $name =  $request->input('name');
		$email =  $request->input('email');
		$os0 =  $request->input('os0');
		$country =  $request->input('country');
		$phone =  $request->input('phone');
		$date =  $request->input('date');
		$uuid =  $request->input('uuid');
		$product =  $request->input('product');
		
		$domain = preg_replace('#^https?://#', '', Http::root());
		$phone = "+". $country ." ". $phone;
		
		$from = explode(" ",$os0);
		
		DB::table('rev_orders')->insert([
			'id' => $uuid,
			'product' => $product,
			'name' => $name,
			'email' => $email,
			'phone' => $phone,
			'traveller' => $from[0],
			'date' => $date,
			'from' => $domain
			]);
		
		Mail::to('guide@vertikaltrip.com')->send(new BookingTour($product,$name,$email,$phone,$date,$os0));
		
    }
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
		if($request->ajax())
		{
			$orders = rev_orders::where('id','<>','');
			return Datatables::eloquent($orders)
				->addIndexColumn()
				->addColumn('action', function ($order) {
					return '<div class="btn-toolbar justify-content-end"><div class="btn-group mr-2 mb-2" role="group"><button id="btn-edit" type="button" onClick="EDIT(\''.$order->id.'\'); return false;" class="btn btn-success"><i class="fa fa-edit"></i> Edit</button><button id="btn-del" type="button" onClick="DELETE(\''. $order->id .'\')" class="btn btn-danger"><i class="fa fa-trash-alt"></i> Delete</button></div></div>';
				})
				->rawColumns(['action'])
				->toJson();
		}
        return view('rev.order.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rev.order.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
          	'name' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'max:255'],
			'phone' => ['required', 'string', 'max:255'],
       	]);
        
       	if ($validator->fails()) {
            $errors = $validator->errors();
			return response()->json($errors);
       	}
		
		$product = $request->input('product');
		$name = $request->input('name');
		$email = $request->input('email');
		$phone = $request->input('phone');
		$date = $request->input('date');
		$from = $request->input('from');
		$traveller = $request->input('traveller');
		
		$rev_orders = new rev_orders();
		$rev_orders->product = $product;
		$rev_orders->name = $name;
		$rev_orders->email = $email;
		$rev_orders->phone = $phone;
		$rev_orders->date = $date;
		$rev_orders->from = $from;
		$rev_orders->traveller = $traveller;
		$rev_orders->status = 1;
		$rev_orders->save();
		
		return response()->json([
					"id" => "1",
					"message" => 'Success'
				]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$order = rev_orders::findOrFail($id);
        return view('rev.order.edit')->with('order',$order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$validator = Validator::make($request->all(), [
          	'name' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'max:255'],
			'phone' => ['required', 'string', 'max:255'],
       	]);
        
       	if ($validator->fails()) {
            $errors = $validator->errors();
			return response()->json($errors);
       	}
		
		$product = $request->input('product');
		$name = $request->input('name');
		$email = $request->input('email');
		$phone = $request->input('phone');
		$date = $request->input('date');
		$from = $request->input('from');
		$traveller = $request->input('traveller');
		
		$rev_orders = rev_orders::findOrFail($id);
		$rev_orders->product = $product;
		$rev_orders->name = $name;
		$rev_orders->email = $email;
		$rev_orders->phone = $phone;
		$rev_orders->date = $date;
		$rev_orders->from = $from;
		$rev_orders->traveller = $traveller;
		$rev_orders->save();
		
		return response()->json([
					"id" => "1",
					"message" => 'Success'
				]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rev_orders = rev_orders::find($id);
		$rev_orders->delete();
    }
}
