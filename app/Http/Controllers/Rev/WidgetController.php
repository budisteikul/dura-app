<?php

namespace App\Http\Controllers\Rev;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\DataTables\Rev\WidgetsDataTable;
use Illuminate\Support\Facades\Validator;
use App\Models\Rev\rev_widgets;
use App\Models\Blog\blog_posts;

use Illuminate\Support\Facades\Auth;

class WidgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(WidgetsDataTable $dataTable)
    {
        return $dataTable->render('rev.widgets.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$user = Auth::user();
		$blog_post = blog_posts::doesnthave('widgets')->where('content_type','standard')->where('user_id',$user->id)->orderBy('title')->get();
        return view('rev.widgets.create',['blog_post'=>$blog_post]);
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
          	'post_id' => ['required'],
       	]);
        
       	if ($validator->fails()) {
            $errors = $validator->errors();
			return response()->json($errors);
       	}
		
		$post_id =  $request->input('post_id');
		$product =  $request->input('product');
		$checkout =  $request->input('checkout');
		$receipt =  $request->input('receipt');
		$time_selector =  $request->input('time_selector');
		
		$rev_widgets = new rev_widgets();
		$rev_widgets->post_id = $post_id;
		$rev_widgets->product = $product;
		$rev_widgets->checkout = $checkout;
		$rev_widgets->receipt = $receipt;
		$rev_widgets->time_selector = $time_selector;
		$rev_widgets->save();
		
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
		$user = Auth::user();
        $rev_widgets = rev_widgets::findOrFail($id);
		$blog_post = blog_posts::doesnthave('widgets')->orWhere('id',$rev_widgets->post_id)->where('content_type','standard')->where('user_id',$user->id)->orderBy('title')->get();
        return view('rev.widgets.edit',['rev_widgets'=>$rev_widgets,'blog_post'=>$blog_post]);
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
          	'post_id' => ['required'],
       	]);
        
       	if ($validator->fails()) {
            $errors = $validator->errors();
			return response()->json($errors);
       	}
		
		$post_id =  $request->input('post_id');
		$product =  $request->input('product');
		$checkout =  $request->input('checkout');
		$receipt =  $request->input('receipt');
		$time_selector =  $request->input('time_selector');
		
		$rev_widgets = rev_widgets::findOrFail($id);
		$rev_widgets->post_id = $post_id;
		$rev_widgets->product = $product;
		$rev_widgets->checkout = $checkout;
		$rev_widgets->receipt = $receipt;
		$rev_widgets->time_selector = $time_selector;
		$rev_widgets->save();
		
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
        $rev_widgets = rev_widgets::find($id);
		$rev_widgets->delete();
    }
}
