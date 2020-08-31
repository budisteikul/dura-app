<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ProductDataTable;
use Illuminate\Support\Facades\Validator;
use App\Models\Products;
use PDF;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
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
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);
        
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json($errors);
        }
        
        $name =  $request->input('name');
        $sku =  $request->input('sku');
        $price =  $request->input('price');
        
        $products = new Products();
        $products->name = $name;
        $products->sku = $sku;
        $products->price = $price;
        $products->save();
        
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

       $product = Products::findOrFail($id);
       //return view('products.show',['product'=>$product]);
       $customPaper = array(0,0,200,500);
       $pdf = PDF::loadview('products.show',['product'=>$product])->setPaper($customPaper);
       return $pdf->stream('barcode.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Products::findOrFail($id);
        return view('products.edit',['product'=>$product]);
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
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);
        
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json($errors);
        }
        
        $name =  $request->input('name');
        $sku =  $request->input('sku');
        $price =  $request->input('price');
        
        $products = Products::findOrFail($id);
        $products->name = $name;
        $products->sku = $sku;
        $products->price = $price;
        $products->save();
        
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
        Products::find($id)->delete();
    }
}
