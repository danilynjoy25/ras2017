@extends('layouts.WMS')
@section('title')
<title>Weather Monitoring - Charts</title>
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
    <a class="nav-link" href="#">
      <i class="fa fa-fw fa-area-chart"></i>
      <span class="nav-link-text">Charts</span>
    </a>
  </li>
  <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
    <a class="nav-link" href="/wms/tables">
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
    <li class="breadcrumb-item active">Charts</li>
  </ol>
@endpush
@push('content')
    <div class="col-12">
        <div class="card mb-3">
            <div class="card-header"><i class="fa fa-area-chart"></i> WMS Line Chart</div>
                <div class="card-body">
                  <canvas id="myChart" width="100%" height="30"></canvas>
                </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>
        @include('wms.chartjs')
    <div class="container-fluid">
      <div class="card card-login mx-auto mt-5" style = "width: 500px; ">
        <div class="card-header"><i class="fa fa-fw fa-wrench"></i> Chart Settings</div>
          <div class="card-body">
            <ul class="list-inline mb-0" style = "overflow:hidden;">
              <li class="nav-item">
                Station:
                <select class="selectpicker" style="float:right;">
                  <option>0</option>
                  <option>1</option>
                  <option>2</option>
                </select>
              </li>
              <li class="nav-item">
                Parameter:
                <select class="selectpicker" style="float:right;">
                  <option>Temperature</option>
                  <option>Humidity</option>
                  <option>Air pressure</option>
                  <option>Light</option>
                  <option>Wind direction</option>
                  <option>Wind speed</option>
                  <option>Rain intensity</option>
                </select>
              </li>
              <li class="nav-item">
                Filter by:
                <select class="selectpicker" style="float:right;">
                  <option>Day</option>
                  <option>Month</option>
                  <option>Year</option>
                </select>
              </li>
              <li class="nav-item">
                Format:
                <select class="selectpicker" style="float:right;">
                  <option>Line</option>
                  <option>Area</option>
                  <option>Bar</option>
                </select>
              </li>

            </ul>
          </div>
      <div class="card-footer small text-muted">
        <a class="btn btn-primary btn-block" href="#">Update</a>
      </div>
      </div>
    </div>
  </div> <!-- col-12 -->

@endpush
