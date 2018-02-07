@extends('layouts.home')

@section('content')

<div class="container" style="padding-top: 30px; padding-bottom: 30px">

      <div class="card mb-3">
        <div class="card-header"><span class="glyphicon glyphicon-user"></span>
          <h3>User Profile</h3>
        </div>
        <div class="card-body">

          <table style="height: 200px;">
          <tbody>
          <tr>
          <td style="width: 25%;">
            <a><img src="http://via.placeholder.com/200"></a>
          </td>
          <td style="padding-left: 20px">
            <h1>{{Auth::user()->name}}</h1>
            <h4>{{ Auth::user()->getRoleNames()->implode(',')}}</h4>
            <h5>{{ Auth::user()->email}}</h5>
          </td>
          </tr>
          </tbody>
          </table>

        </div>
      </div>

      <script type="text/javascript">
          $(document).ready(function(){
              $('#userTable').DataTable();
          });
      </script>
    @can('Administer roles & permissions')

    <div class="card card-login" style="margin-top:10px">
        <div class="card-header"><span class="glyphicon glyphicon-user"></span><h3>Users</h3></div>
        <div class="card-body">
          <div class="table-responsive">
              <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date/Time Added</th>
                        <th>User Roles</th>
                        <th>Operations</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $user)
                    <tr>

                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('F d, Y h:ia') }}</td>
                        <td>{{  $user->roles()->pluck('name')->implode(' ') }}</td>{{-- Retrieve array of roles associated to a user and convert to string --}}

                        <td style="display:flex">
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                        {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id] ]) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
          <a class="btn btn-success" href="{{route('users.index')}}"> View user settings </a>
        </div>
    <div class="card-footer small text-muted">Updated at</div>
    </div>
    @endcan

    @if(Auth::user()->hasAnyPermission(['Add sensor', 'Delete sensor', 'Edit sensors']))
    <div class="card card-login" style="margin-top:10px; margin-bottom: 10px">
      <div class="card-header"><span class="glyphicon glyphicon-user"></span><h3>Sensors</h3></div>
        <div class="card-body">
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
                          <td style="display: flex;">
                          <a href="{{ URL::to('sensors/'.$sensor->c_id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                          {!! Form::open(['method' => 'DELETE', 'route' => ['sensors.destroy', $sensor->c_id] ]) !!}
                          {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                          {!! Form::close() !!}

                          </td>
                      </tr>
                      @endforeach
                 </tbody>
              </table>

          <a href="{{ route('sensors.index') }}" class="btn btn-success">View all sensors</a>

        </div>
        <div class="card-footer small text-muted">Updated at</div>
    </div>

</div>
@endif

@stop

@section('footer')
<footer class="py-5 bg-dark" style="">
  <div class="container">
    <p class="m-0 text-center text-white">Copyright &copy; ADMU Monitoring 2018</p>
  </div>
  <!-- /.container -->
</footer>
@endsection('footer')
