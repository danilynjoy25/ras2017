<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Session;

class SensorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth', 'clearance'])
            ->except('index', 'show');
    }
    
    public function index()
    {
        $sensors = \App\Models\Sensor::all();

        return view('sensors.index')->with('sensors', $sensors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
     {
       return view('sensors.create');
     }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
       $this->validate($request, [
           'type'=>'required',
           'name' =>'required',
           ]);

       $type = $request['type'];
       $name = $request['name'];

       $sensor = \App\Models\Sensor::create(['c_type'=>$type, 'c_name' => $name]);

       return redirect()->route('sensors.index')
           ->with('flash_message', 'Sensor,
            '. $sensor->c_name.' created');
   }

   /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function show($id)
   {
       $sensor = \App\Models\Sensor::findOrFail($id);

       return view ('sensors.show', compact('sensor'));
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function edit($id)
   {
       $sensor = \App\Models\Sensor::findOrFail($id);

       return view('sensors.edit', compact('sensor'));
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
       $this->validate($request, [
             'type'=>'required',
             'name' =>'required',
         ]);

       $sensor = \App\Models\Sensor::findOrFail($id);
       $sensor->c_type = $request->input('type');
       $sensor->c_name = $request->input('name');
       $sensor->save();

       return redirect()->route('sensors.index',
           $sensor->c_id)->with('flash_message',
           'Sensor, '. $sensor->c_name.' updated');
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {
       $sensor = \App\Models\Sensor::findOrFail($id);
       $sensor->delete();

       return redirect()->route('sensors.index')
           ->with('flash_message',
            'Sensor successfully deleted');
   }
}
