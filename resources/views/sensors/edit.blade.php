@extends('layouts.home')

<!-- @section('title', '| Edit Role') -->

@section('content')

<div class="container" style="padding-top: 30px; padding-bottom: 30px">
    <h1><i class='fa fa-key'></i> Edit sensor: {{$sensor->c_name}}</h1>
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
        {{ Form::select('type', $projects, null, ['class' => 'form-control']) }}
    </div>

    {{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}
</div>

@endsection

@section('footer')
<footer class="py-5 bg-dark" style="">
  <div class="container">
    <p class="m-0 text-center text-white">Copyright &copy; ADMU Monitoring 2018</p>
  </div>
  <!-- /.container -->
</footer>
@endsection('footer')
