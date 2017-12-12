<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
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
	      return view('wms.tables', compact('sensor_data'));
    }

    public function chart()
    {
      $value = DB::table('t_sensor_data')
          ->where([
            ['c_sensor', '=', '0'],
            ['c_sensed_parameter', '=', 'temp']
          ])
          ->select('c_value')
          ->orderBy('c_time')
          ->get()->toArray();
      $value = array_column($value, 'c_value');

      $time = DB::table('t_sensor_data')
          ->where([
            ['c_sensor', '=', '0'],
            ['c_sensed_parameter', '=', 'temp']
          ])
          ->select('c_time')
          ->orderBy('c_time')
          ->get()->toArray();
      $time = array_column($time, 'c_time');

      return view('wms.charts')
              ->with('value',json_encode($value,JSON_NUMERIC_CHECK))
              ->with('time',json_encode($time,JSON_NUMERIC_CHECK));
    }

}
