<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 't_projects';

    public function users() {
      return $this->hasMany('User');
    }

    public function sensors() {
      return $this->hasMany('Sensor');
    }
}
