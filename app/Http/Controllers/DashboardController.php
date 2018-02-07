<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Session;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = \App\Models\User::all();
        $sensors = \App\Models\Sensor::all();
        $sensor_data = \App\Models\Sensor_data::all();

        return view('dashboard')
              ->with('users', $users)
              ->with('sensor_data', $sensor_data)
              ->with('sensors', $sensors);
    }

}
