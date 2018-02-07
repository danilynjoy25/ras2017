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
    //Get station and parameter from form
    $station = request('station');
    $parameter = request('parameter');

    if($parameter == null){
      $parameter = 'Temperature';
    }

    if($station == null){
      $station = 0;
    }

    //Get chart data (x, y) as array(key, value)
    $data = DB::table('t_sensor_data')
        ->where([
          ['c_sensor', '=', $station],
          ['c_sensed_parameter', '=', $parameter]
        ])
        ->orderBy('c_time')
        ->pluck('c_value', 'c_time')
        ->toArray();

    //Get first and last keys of $data
    $keys = array_keys($data);
    $last_key = end($keys);

    reset($data);
    $first_key = key($data);

    //Get chart data with y in UNIX time format [x,y]
    $dataFinal = array();
    foreach ($data as $key => $val) {
      $dataFinal[] = array(strtotime($key)*1000, $val);
    }

    //List stations and parameters
    //pluck(key, value)
    //Form-> name=value value=key
    $stationsArray= DB::table('t_sensor_data')
        ->join('t_sensors', 't_sensors.c_id', '=', 't_sensor_data.c_sensor')
        ->where('t_sensors.c_type', '=', 'WMS')
        ->pluck('t_sensors.c_name', 't_sensors.c_id');

    $parametersArray = DB::table('t_sensor_data')
        ->join('t_sensors', 't_sensors.c_id', '=', 't_sensor_data.c_sensor')
        ->where('t_sensors.c_type', '=', 'WMS')
        ->groupBy('c_sensed_parameter')
        ->distinct()
        ->pluck('c_sensed_parameter', 'c_sensed_parameter');

    $stationName = DB::table('t_sensors')
        ->where('c_id','=',$station)
        ->select('c_name')
        ->value('c_name');

    //Get last data's date
    $lastDate = DB::table('t_sensor_data')
        ->orderBy('c_time', 'desc')
        ->select('c_time')
        ->limit(1)
        ->value('c_time');
    $lastDate = date("d F Y H:i:s", strtotime($lastDate));

    return view('wms.summary')
        ->with('stationsArray', $stationsArray)
        ->with('parametersArray', $parametersArray)
        ->with('station', json_encode($station,JSON_NUMERIC_CHECK))
        ->with('stationName', json_encode($stationName,JSON_NUMERIC_CHECK))
        ->with('parameter', json_encode($parameter,JSON_NUMERIC_CHECK))
        ->with('valueArray', json_encode($data,JSON_NUMERIC_CHECK))
        ->with('dataFinal', json_encode($dataFinal,JSON_NUMERIC_CHECK))
        ->with('lastDate', json_encode($lastDate,JSON_NUMERIC_CHECK));
    }


    public function tables()
    {
       //Display all sensor data
        $sensor_data = \App\Models\Sensor_data::all();
	      return view('wms.tables', compact('sensor_data'));
    }


    public function chart()
    {
      //Get station and parameter from form
      $station = request('station');
      $parameter = request('parameter');

      if($parameter == null){
        $parameter = 'Temperature';
      }

      if($station == null){
        $station = 0;
      }

      //Get chart data (x, y) as array(key, value)
      $data = DB::table('t_sensor_data')
          ->where([
            ['c_sensor', '=', $station],
            ['c_sensed_parameter', '=', $parameter]
          ])
          ->orderBy('c_time')
          ->pluck('c_value', 'c_time')
          ->toArray();

      //Get first and last keys of $data
      $keys = array_keys($data);
      $last_key = end($keys);

      reset($data);
      $first_key = key($data);

      //Get chart data with y in UNIX time format [x,y]
      $dataFinal = array();
      foreach ($data as $key => $val) {
        $dataFinal[] = array(strtotime($key)*1000, $val);
      }

      //List stations and parameters
      //pluck(key, value)
      //Form-> name=value value=key
      $stationsArray= DB::table('t_sensor_data')
          ->join('t_sensors', 't_sensors.c_id', '=', 't_sensor_data.c_sensor')
          ->where('t_sensors.c_type', '=', 'WMS')
          ->pluck('t_sensors.c_name', 't_sensors.c_id');

      $parametersArray = DB::table('t_sensor_data')
          ->join('t_sensors', 't_sensors.c_id', '=', 't_sensor_data.c_sensor')
          ->where('t_sensors.c_type', '=', 'WMS')
          ->groupBy('c_sensed_parameter')
          ->distinct()
          ->pluck('c_sensed_parameter', 'c_sensed_parameter');

      $stationName = DB::table('t_sensors')
          ->where('c_id','=',$station)
          ->select('c_name')
          ->value('c_name');

      //Get last data's date
      $lastDate = DB::table('t_sensor_data')
          ->orderBy('c_time', 'desc')
          ->select('c_time')
          ->limit(1)
          ->value('c_time');
      $lastDate = date("d F Y H:i:s", strtotime($lastDate));

      return view('wms.charts')
          ->with('stationsArray', $stationsArray)
          ->with('parametersArray', $parametersArray)
          ->with('station', json_encode($station,JSON_NUMERIC_CHECK))
          ->with('stationName', json_encode($stationName,JSON_NUMERIC_CHECK))
          ->with('parameter', json_encode($parameter,JSON_NUMERIC_CHECK))
          ->with('valueArray', json_encode($data,JSON_NUMERIC_CHECK))
          ->with('dataFinal', json_encode($dataFinal,JSON_NUMERIC_CHECK))
          ->with('lastDate', json_encode($lastDate,JSON_NUMERIC_CHECK));
    }

}
