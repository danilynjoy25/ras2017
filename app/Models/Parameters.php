<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parameters extends Model
{
    protected $table = 't_sensors';
    protected $primaryKey = 'c_id';
    protected $fillable = ['c_sensor', 'c_sensed_parameter', 'c_value'];

}
