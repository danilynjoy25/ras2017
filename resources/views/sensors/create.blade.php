@extends('layouts.home')

<!-- @section('title', '| Add Role') -->

@section('content')

<div class="container" style="padding-top: 30px; padding-bottom: 30px">

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
        {{ Form::select('type', $projects, null, ['class' => 'form-control']) }}

    </div>

    {{ Form::submit('Add sensor', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

</div>

@endsection

@section('footer')
<footer class="py-5 bg-dark" style="width: 100%">
    <p class="m-0 text-center text-white">Copyright &copy; ADMU Monitoring 2018</p>
  <!-- /.container -->
</footer>
@endsection('footer')
