<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;

class APIController extends Controller
{
    // protected function addRoute(ControllerCollection $controllers){
    //     $controllers->post('/api', array($this, 'receive'));
    // }

    public static function receive(Request $request){

        $data = $request->input('data');

        $added = 0;

        // Get data from json

        //$arr = json_encode($json, true);

        //$contents = json_decode($arr, true);

        // Get latest date from the database
        $lastDBdate = \App\Models\Sensor_data::orderBy('c_time', 'desc')
                  ->limit(1)
                  ->value('c_time');

        $lastDBdate = strtotime($lastDBdate);

        //Get latest parameters
        $lastDBparameters = \App\Models\Sensor_data::
        select('c_sensed_parameter')
        ->where('c_time', '=', DB::raw('(SELECT max(c_time) FROM t_sensor_data)'))
        ->get()
        ->pluck('c_sensed_parameter')
        ->toArray();

        foreach($data as $field){
          $jsonDate = strtotime($field['c_time']);
          $jsonParameter = $field['c_sensed_parameter'];

            if($jsonDate > $lastDBdate) {

              DB::table('t_sensor_data')
              ->insert([
                   'c_time' => $field['c_time'],
                   'c_sensor' => $field['c_sensor'],
                   'c_sensed_parameter' => $field['c_sensed_parameter'] ,
                   'c_value' =>  $field['c_value']
                 ]);

              $added += 1;
            } else if(($jsonDate == $lastDBdate) & !in_array($jsonParameter, $lastDBparameters)){
                    DB::table('t_sensor_data')
                    ->insert([
                         'c_time' => $field['c_time'],
                         'c_sensor' => $field['c_sensor'],
                         'c_sensed_parameter' => $field['c_sensed_parameter'] ,
                         'c_value' =>  $field['c_value']
                       ]);

            } // else if
        } //foreach

        //VAR_DUMP($data);
        echo $added . " data added. \n";

    }

}
