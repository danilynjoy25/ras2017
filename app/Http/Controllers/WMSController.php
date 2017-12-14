<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Sensor_data;
use App\Models\Sensor;
use Illuminate\Support\Collection;

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
            ['c_sensed_parameter', '=', 'temperature']
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

      //Chart settings
      $stations= DB::table('t_sensor_data')
          ->join('t_sensors', 't_sensors.c_id', '=', 't_sensor_data.c_sensor')
          ->where('t_sensors.c_type', '=', 'WMS')
          ->pluck('t_sensors.c_name', 't_sensors.c_id');

      $parameters = DB::table('t_sensor_data')
          ->join('t_sensors', 't_sensors.c_id', '=', 't_sensor_data.c_sensor')
          ->where('t_sensors.c_type', '=', 'WMS')
          ->groupBy('c_sensed_parameter')
          ->distinct()
          ->pluck('c_sensed_parameter', 'c_time');

      return view('wms.charts')
          ->with('value',json_encode($value,JSON_NUMERIC_CHECK))
          ->with('time',json_encode($time,JSON_NUMERIC_CHECK))
          ->with('stations', $stations)
          ->with('parameters', $parameters);
    }

    public function create()
    {

    }

}
