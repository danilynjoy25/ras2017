@extends('layouts.WMS')
@section('title')
<title>Weather Monitoring Site</title>
@endsection
@push('navigation')
<ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
  <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Summary">
    <a class="nav-link" href="wms">
      <i class="fa fa-fw fa-dashboard"></i>
      <span class="nav-link-text">Summary</span>
    </a>
  </li>
  <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
    <a class="nav-link" href="wms/charts">
      <i class="fa fa-fw fa-area-chart"></i>
      <span class="nav-link-text">Charts</span>
    </a>
  </li>
  <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
    <a class="nav-link" href="wms/tables">
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
    <li class="breadcrumb-item active">Summary</li>
  </ol>
@endpush
@push('content')
  <div class="col-12">
        <div class="card mb-3">
            <div class="card-header"><i class="fa fa-area-chart"></i> WMS Summary</div>
                <div class="card-body">
                  <canvas id="myBarChart" width="100%" height="30"></canvas>
                </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>
    @include('wms.summaryjs')
    </div>
  </div>
@endpush
