<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use App\DataTables\Home\RelayDataTable;
use App\Models\Home\Relay;
use Storage;

use App\Classes\Home\Relay\Relay as RelayClass;
use App\Classes\Home\Relay\GPIO;

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
            'ipOrGpio' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json($errors);
        }

        $name =  $request->input('name');
        $ipOrGpio =  $request->input('ipOrGpio');
        $username =  $request->input('username');
        $password =  $request->input('password');
        $type =  $request->input('type');
        
        $relay = new Relay();
        $relay->name = $name;
        $relay->ipOrGpio = $ipOrGpio;
        $relay->username = $username;
        $relay->password = $password;
        $relay->state = 'on';
        $relay->type = $type;
        $relay->save();

        RelayClass::action($relay->id, 'on');
        
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
            RelayClass::action($relay->id);
            return response()->json([
                    "id" => "1",
                    "message" => 'Success'
                ]);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'ipOrGpio' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json($errors);
        }

        $name =  $request->input('name');
        $ipOrGpio =  $request->input('ipOrGpio');
        $username =  $request->input('username');
        $password =  $request->input('password');
        $type =  $request->input('type');
        
        $relay = Relay::findOrFail($id);
        $relay->name = $name;
        $relay->ipOrGpio = $ipOrGpio;
        $relay->username = $username;
        $relay->password = $password;
        $relay->type = $type;
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
        Storage::delete('relay/'. $relay->id);
        $relay->delete();
    }

    public function webhook(Request $request)
    {
        
        $data = $request->all();
        $state = $data['queryResult']['parameters']['state'];
        $device = $data['queryResult']['parameters']['device'];
        $relay = Relay::findOrFail($device);

        if($state=="state")
        {
            if($relay->state=="on")
            {
                $response = "Status lampu menyala";
            }
            else
            {
                $response = "Status lampu mati";
            }
            
            return response()->json(json_decode('{"payload": {"google": {"expectUserResponse": true,"richResponse": {"items": [{"simpleResponse": {"textToSpeech": "'.  $response .'"}}]}}}}'));
        }

        RelayClass::action($relay->id,$state);
        if($state==on)
        {
            $response = "OK, lampu udah dinyalakan";
        }
        else
        {
            $response = "OK, lampu udah dimatikan";
        }
        return response()->json(json_decode('{"payload": {"google": {"expectUserResponse": true,"richResponse": {"items": [{"simpleResponse": {"textToSpeech": "'.  $response .'"}}]}}}}'));
    }

    public function toggle_action($id,$action)
    {
            $relay = Relay::findOrFail($id);
            RelayClass::action($relay->id,$action);
            return response()->json([
                    "id" => "1",
                    "message" => 'Success'
                ]);
        
    }

    public function toggle($id)
    {

            $relay = Relay::findOrFail($id);
            RelayClass::action($relay->id);
            return response()->json([
                    "id" => "1",
                    "message" => 'Success'
                ]);
    }
}
