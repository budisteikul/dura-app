<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Home\LampsDataTable;
use Illuminate\Support\Facades\Validator;
use App\Models\Home\home_lamps;

class LampController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LampsDataTable $dataTable)
    {
        return $dataTable->render('home.lamp.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home.lamp.create');
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
            'ip' => 'required|string|max:255',
            'name' => 'required|string|max:255',
        ]);
        
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json($errors);
        }
        
        $name =  $request->input('name');
        $ip =  $request->input('ip');
        
        $home_lamps = new home_lamps();
        $home_lamps->name = $name;
        $home_lamps->ip = $ip;
        $home_lamps->save();
        
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
        //
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
                    'state' => 'in:0,1',
                    
            ]);
                
            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json($errors);
            }
            
            $home_lamps = home_lamps::find($id);
            $state = $request->input('state');

            $headers = [
                'Accept' => 'application/json',
            ];
            $client = new \GuzzleHttp\Client(['headers' => $headers,'exceptions' => false]);
            $url = 'http://'.$home_lamps->ip.'/gpio/'. strtoupper($state);
           
            $request = $client->get($url);

           
            $home_lamps->state = $state;
            $home_lamps->save();

            return response()->json([
                    "id"=>"1",
                    "message"=>'success'
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
        home_lamps::find($id)->delete();
    }
}
