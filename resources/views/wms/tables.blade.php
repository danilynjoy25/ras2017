@extends('layouts.WMS')
@section('title')
<title>Weather Monitoring - Tables </title>
@endsection
@push('navigation')
<ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
  <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Summary">
    <a class="nav-link" href="/wms">
      <i class="fa fa-fw fa-dashboard"></i>
      <span class="nav-link-text">Summary</span>
    </a>
  </li>
  <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
    <a class="nav-link" href="/wms/charts">
      <i class="fa fa-fw fa-area-chart"></i>
      <span class="nav-link-text">Charts</span>
    </a>
  </li>
  <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
    <a class="nav-link" href="#">
      <i class="fa fa-fw fa-table"></i>
      <span class="nav-link-text">Tables</span>
    </a>
  </li>
</ul>
@endpush
@push('breadcrumb')
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="wms">Weather Monitoring</a>
    </li>
    <li class="breadcrumb-item active">Tables</li>
  </ol>
@endpush
@push('content')
<div class="col-12">
	<div class="card mb-3">
			<div class="card-header">
			  <i class="fa fa-table"></i> Data Table Example</div>
			<div class="card-body">
			  <div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				  <thead>
					<tr>
					  <th>Time</th>
					  <th>Sensor</th>
					  <th>Parameter</th>
					  <th>Value</th>
					</tr>
				  </thead>
				  <!--
				  <tfoot>
					<tr>
					  <th>Name</th>
					  <th>Position</th>
					  <th>Office</th>
					  <th>Age</th>
					  <th>Start date</th>
					  <th>Salary</th>
					</tr>
				  </tfoot>
				  -->
				  <tbody>
				  @foreach($sensor_data as $data)
					<tr>
					  <td>{{ $data->c_time }}</td>
					  <td>{{ $data->c_sensor }}</td>
					  <td>{{ $data->c_sensed_parameter }}</td>
					  <td>{{ $data->c_value }}</td>
					</tr>
				  @endforeach
				  </tbody>
				</table>
			  </div>
			</div>
			<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
		  </div>
		</div>

	</div>
@endpush
