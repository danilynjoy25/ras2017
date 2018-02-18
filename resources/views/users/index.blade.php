@extends('layouts.home')

<!-- @section('title', '| Users') -->

@section('content')

<div class="container" style="padding-top: 30px; padding-bottom: 30px">

  @if(Session::has('flash_message'))
      <div class="alert alert-success">
        <em> {!! session('flash_message') !!}</em>
      </div>
  @endif

    <h4><i class="fa fa-users"></i> User Administration
      <div style="float: right">
      <a href="{{ route('roles.index') }}" class="btn btn-secondary">Roles</a>
      <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Permissions</a></h1>
    <hr>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">

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
                <tr style="white-space: nowrap">

                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('F d, Y h:ia') }}</td>
                    <td>{{  $user->roles()->pluck('name')->implode(' ') }}</td>{{-- Retrieve array of roles associated to a user and convert to string --}}

                    <td>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info" style="">Edit</a>
                    {!! Form::open([
                        'method' => 'DELETE', 
                        'route' => ['users.destroy', $user->id],
                        'onsubmit' => "return confirm('Are you sure you want to delete this user?')"
                    ]) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    <a href="{{ route('users.create') }}" class="btn btn-success">Add User</a>

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
