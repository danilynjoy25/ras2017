<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sensor_data extends Model
{
    protected $table = 't_sensor_data';

    public function project() {
      return $this->belongsTo('App\Models\Project');
    }

    public function sensor() {
      return $this->belongsTo('App\Models\Sensor');
    }

}
