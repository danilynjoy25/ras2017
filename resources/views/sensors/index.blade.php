@extends('layouts.home')

@section('content')

<div class="container" style="padding-top: 30px; padding-bottom: 30px">

  @if(Session::has('flash_message'))
      <div class="alert alert-success">
        <em> {!! session('flash_message') !!}</em>
      </div>
  @endif

    <h1><i class="fa fa-key"></i> Sensors

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

                    {!! Form::open([
                        'method' => 'DELETE',
                        'route' => ['sensors.destroy', $sensor->c_id],
                        'onsubmit' => "return confirm('Are you sure you want to delete this sensor?')"
                    ]) !!}
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

@section('footer')
<footer class="py-5 bg-dark" style="width: 100%">
    <p class="m-0 text-center text-white">Copyright &copy; ADMU Monitoring 2018</p>
  <!-- /.container -->
</footer>
@endsection('footer')
