@extends('layouts.admin')
@section('content')
<div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-pie-chart" aria-hidden="true"></i><a href="#">Charts</a></li>
            <li><a>Morris</a></li>
        </ul>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<div class="row animated fadeInUp">
    <div class="col-sm-12">
        <h4 class="section-subtitle text-center">
            <b>Morris Chart</b>
        </h4>
    </div>
    <div class="col-sm-8 col-sm-offset-2">
        <p class="section-text text-center  mb-xl">It's a very simple API for drawing <span class="highlight">line</span>, <span class="highlight">bar</span>, <span class="highlight">area</span> and <span class="highlight">donut</span> charts. For more <a href="http://morrisjs.github.io/morris.js/">Info</a>
        </p>
    </div>
    <!--LINE CHART-->
    <div class="col-sm-6 col-md-4">
        <h4 class="section-subtitle"><b>Line</b> Chart</h4>
        <div class="panel">
            <div class="panel-content">
                <div id="line-example"></div>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--AREA CHART-->
    <div class="col-sm-6 col-md-4">
        <h4 class="section-subtitle"><b>Area</b> Chart</h4>
        <div class="panel">
            <div class="panel-content">
                <div id="area-example"></div>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--AREA STACKED CHART-->
    <div class="col-sm-6 col-md-4">
        <h4 class="section-subtitle"><b>Area Stacked</b> Chart</h4>
        <div class="panel">
            <div class="panel-content">
                <div id="area-stacked-example"></div>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--BAR CHART-->
    <div class="col-sm-6 col-md-4">
        <h4 class="section-subtitle"><b>Bar</b> Chart</h4>
        <div class="panel">
            <div class="panel-content">
                <div id="bar-example"></div>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--BAR STACKED CHART-->
    <div class="col-sm-6 col-md-4">
        <h4 class="section-subtitle"><b>Bar Stacked</b> Chart</h4>
        <div class="panel">
            <div class="panel-content">
                <div id="bar-stacked-example"></div>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--DONUT CHART-->
    <div class="col-sm-6 col-md-4">
        <h4 class="section-subtitle"><b>Donut</b> Chart</h4>
        <div class="panel">
            <div class="panel-content">
                <div id="donut-example"></div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('vendor/morris-chart/raphael.min.js') }}"></script>
<script src="{{ asset('vendor/morris-chart/morris.min.js') }}"></script>
<script src="{{ asset('js/examples/charts/morris.js') }}"></script>
@stop