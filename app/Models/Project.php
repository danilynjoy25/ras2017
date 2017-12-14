<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 't_projects';

    public function users() {
      return $this->hasMany('App\Models\User');
    }

    public function data() {
      return $this->hasManyThrough('App\Models\Sensor_data', 'App\Models\Sensor');
    }

    public function sensors() {
      return $this->hasMany('App\Models\Sensor');
    }

}
