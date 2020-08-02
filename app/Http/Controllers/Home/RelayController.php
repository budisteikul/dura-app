<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use App\DataTables\Home\RelayDataTable;
use App\Models\Home\Relay;
use Storage;

use App\Classes\Home\Relay\Tasmota;

class RelayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RelayDataTable $dataTable)
    {
        return $dataTable->render('home.relay.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home.relay.create');
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
            'ip' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json($errors);
        }

        $name =  $request->input('name');
        $ip =  $request->input('ip');
        $username =  $request->input('username');
        $password =  $request->input('password');
        
        $relay = new Relay();
        $relay->name = $name;
        $relay->ip = $ip;
        $relay->username = $username;
        $relay->password = $password;
        $relay->state = 'off';
        $relay->save();

        Storage::put($relay->id, 'off');
        
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
        $relay = Relay::findOrFail($id);
        return view('home.relay.edit',['relay'=>$relay]);
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
        
        if($request->input('action')=="update")
        {
            $relay = Relay::findOrFail($id);

            if($relay->state=="off")
            {
                Storage::put($relay->id, 'on');
                $relay->state = "on";
                // =============================
                Tasmota::switch($relay->ip,'on',$relay->username,$relay->password);
                // =============================
            }
            else
            {
                Storage::put($relay->id, 'off');
                $relay->state = "off";
                // =============================
                Tasmota::switch($relay->ip,'off',$relay->username,$relay->password);
                // =============================
            }
            
            $relay->save();

            return response()->json([
                    "id" => "1",
                    "message" => 'Success'
                ]);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'ip' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json($errors);
        }

        $name =  $request->input('name');
        $ip =  $request->input('ip');
        $username =  $request->input('username');
        $password =  $request->input('password');
        
        $relay = Relay::findOrFail($id);
        $relay->name = $name;
        $relay->ip = $ip;
        $relay->username = $username;
        $relay->password = $password;
        $relay->save();

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

        $relay = Relay::find($id);
        Storage::delete($relay->id);
        $relay->delete();
    }

    public function toggle($id)
    {
            $relay = Relay::findOrFail($id);

            if($relay->state=="off")
            {
                Storage::put($relay->id, 'on');
                $relay->state = "on";
                // =============================
                Tasmota::switch($relay->ip,'on',$relay->username,$relay->password);
                // =============================
            }
            else
            {
                Storage::put($relay->id, 'off');
                $relay->state = "off";
                // =============================
                Tasmota::switch($relay->ip,'off',$relay->username,$relay->password);
                // =============================
            }
            
            $relay->save();

            return response()->json([
                    "id" => "1",
                    "message" => 'Success'
                ]);
    }

    public function toggle_action($id,$action)
    {
           $relay = Relay::findOrFail($id);

            if($action=="off")
            {
                Storage::put($relay->id, 'off');
                $relay->state = "off";
                // =============================
                Tasmota::switch($relay->ip,'off',$relay->username,$relay->password);
                // =============================
            }
            else
            {
                Storage::put($relay->id, 'on');
                $relay->state = "on";
                // =============================
                Tasmota::switch($relay->ip,'on',$relay->username,$relay->password);
                // =============================
            }
            
            $relay->save();

            return response()->json([
                    "id" => "1",
                    "message" => 'Success'
                ]);
        
    }


}
