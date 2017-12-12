<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sensor_data extends Model
{
    protected $table = 't_sensor_data';

    public function users() {
      return $this->belongsTo('Sensor');
    }
    //
}
