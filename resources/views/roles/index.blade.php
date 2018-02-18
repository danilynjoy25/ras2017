@extends('layouts.home')

<!-- @section('title', '| Roles') -->

@section('content')

<div class="container" style="padding-top: 30px; padding-bottom: 30px">

    <h4><i class="fa fa-users"></i> Roles
      <div style="float: right">
      <a href="{{ route('users.index') }}" class="btn btn-secondary">Users</a>
      <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Permissions</a></h1>
    <hr>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Role</th>
                    <th>Permissions</th>
                    <th>Operation</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($roles as $role)
                <tr>

                    <td>{{ $role->name }}</td>

                    <td>{{  $role->permissions()->pluck('name')->implode(' ') }}</td>{{-- Retrieve array of permissions associated to a role and convert to string --}}
                    <td>
                    <a href="{{ URL::to('roles/'.$role->id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                    {!! Form::open([
                        'method' => 'DELETE',
                        'route' => ['roles.destroy', $role->id],
                        'onsubmit' => "return confirm('Are you sure you want to delete this role?')"
                    ]) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}

                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    <a href="{{ URL::to('roles/create') }}" class="btn btn-success">Add Role</a>

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
