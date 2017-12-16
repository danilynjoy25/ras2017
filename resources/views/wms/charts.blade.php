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
        @include('wms.highchartjsmain')
  </div> <!-- col-12 -->
@endpush
