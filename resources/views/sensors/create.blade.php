@extends('layouts.home')

<!-- @section('title', '| Add Role') -->

@section('content')

<div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='fa fa-key'></i> Add Sensor</h1>
    <hr>
    {{-- @include ('errors.list') --}}

    {{ Form::open(array('url' => 'sensors')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('type', 'Type') }}
        {{ Form::text('type', null, array('class' => 'form-control')) }}
    </div>

    <h5><b>Assign parameters</b></h5>

    <div class='form-group'>
      Parameters checkbox here
    </div>

    {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

</div>

@endsection
