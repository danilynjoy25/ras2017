<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use App\Models\Sensor_data;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use DateTime;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;


class APIController extends Controller
{
    public static function getSensorData(){

          $client = new Client();
          $url = 'http://localhost:3000/Data';
          $status = 'success';

          try {
            $response = $client->request('GET', $url);

            //Get data from json
            $json = $response->getBody();

            $contents = json_decode($json, true);

            //Get latest date from the database
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

            foreach($contents as $field){
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

          } catch (RequestException $e) {

          // If there are network errors, we need to ensure the application doesn't crash.
          // if $e->hasResponse is not null we can attempt to get the message
          // Otherwise, we'll just pass a network unavailable message.

            if ($e->hasResponse()) {
              $exception = (string) $e->getResponse()->getBody();
              $exception = json_decode($exception);
              $status = $e->getCode() . "</br>";$exception;
            } else {
              $status = $e->getMessage();
            }

          }

          return $status;
    }

}
