<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
  protected $table = 't_sensors';

  public function users() {
    return $this->belongsTo('Project');
  }

  public function sensor_data() {
    return $this->hasMany('Sensor_data');
  }
}
