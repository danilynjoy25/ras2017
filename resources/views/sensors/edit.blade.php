@extends('layouts.home')

<!-- @section('title', '| Edit Role') -->

@section('content')

<div class='col-lg-4 col-lg-offset-4'>
    <h1><i class='fa fa-key'></i> Edit Role: {{$sensor->c_name}}</h1>
    <hr>
    {{-- @include ('errors.list')
 --}}
    {{ Form::model($sensor, array('route' => array('sensors.update', $sensor->c_id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('name', 'Sensor name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('type', 'Type') }}
        {{ Form::text('type', null, array('class' => 'form-control')) }}
    </div>

    <h5><b>Assign parameters</b></h5>
      Parameters here
    <br>
    {{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}
</div>

@endsection
