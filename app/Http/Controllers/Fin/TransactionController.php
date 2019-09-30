<?php

namespace App\Http\Controllers\Fin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\DataTables\Fin\TransactionsDataTable;
use Illuminate\Support\Facades\Validator;
use App\Models\Fin\fin_transactions;
use App\Models\Fin\fin_categories;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TransactionsDataTable $dataTable)
    {
        return $dataTable->render('fin.transactions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$fin_categories = fin_categories::orderBy('name')->get();
        return view('fin.transactions.create',['fin_categories'=>$fin_categories]);
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
          	'category_id' => 'required',
			'date' => 'required',
			'amount' => 'required',
       	]);
        
       	if ($validator->fails()) {
            $errors = $validator->errors();
			return response()->json($errors);
       	}
		
		$category_id =  $request->input('category_id');
		$date =  $request->input('date');
		$amount =  $request->input('amount');
		
		$fin_transactions = new fin_transactions();
		$fin_transactions->category_id = $category_id;
		$fin_transactions->date = $date;
		$fin_transactions->amount = $amount;
		$fin_transactions->save();
		
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
        $fin_categories = fin_categories::orderBy('name')->get();
		$fin_transactions = fin_transactions::findOrFail($id);
        return view('fin.transactions.edit',['fin_transactions'=>$fin_transactions,'fin_categories'=>$fin_categories]);
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
          	'category_id' => 'required',
			'date' => 'required',
			'amount' => 'required',
       	]);
        
       	if ($validator->fails()) {
            $errors = $validator->errors();
			return response()->json($errors);
       	}
		
		$category_id =  $request->input('category_id');
		$date =  $request->input('date');
		$amount =  $request->input('amount');
		
		$fin_transactions = fin_transactions::findOrFail($id);
		$fin_transactions->category_id = $category_id;
		$fin_transactions->date = $date;
		$fin_transactions->amount = $amount;
		$fin_transactions->save();
		
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
        $fin_transactions = fin_transactions::find($id);
		$fin_transactions->delete();
    }
}