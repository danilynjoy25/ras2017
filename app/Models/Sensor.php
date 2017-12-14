<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
  protected $table = 't_sensors';

  public function project() {
    return $this->belongsTo('App\Models\Project');
  }

  public function sensor_data() {
    return $this->hasMany('App\Models\Sensor_data');
  }
}
