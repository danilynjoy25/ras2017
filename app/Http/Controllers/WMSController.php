<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Sensor_data;

class WMSController extends Controller
{
    public function summary()
    {
        return view('wms.summary');;
    }
	
	public function tables()
    {
        $sensor_data = \App\Models\Sensor_data::all();
		return view('wms.tables', compact('sensor_data'));;
    }
}
