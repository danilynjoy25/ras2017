@extends('layouts.home')

@section('content')

<div class="col-lg-10 col-lg-offset-1">
    <h1><i class="fa fa-key"></i> Sensors

    <a href="" class="btn btn-default pull-right">Parameters</a>
    </h1>
    <hr>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Project</th>
                    <th>Operation</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($sensors as $sensor)
                <tr>
                    <td>{{ $sensor->c_name }}</td>
                    <td>{{  $sensor->c_type }}</td>
                    {{-- Retrieve array of permissions associated to a role and convert to string --}}
                    <td>
                    <a href="{{ URL::to('sensors/'.$sensor->c_id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                    {!! Form::open(['method' => 'DELETE', 'route' => ['sensors.destroy', $sensor->c_id] ]) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}

                    </td>
                </tr>
                @endforeach
           </tbody>
        </table>
    </div>

    <a href="{{ URL::to('sensors/create') }}" class="btn btn-success">Add Sensor</a>

</div>

@stop
