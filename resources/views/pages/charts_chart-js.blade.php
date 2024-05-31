@extends('layouts.admin')
@section('content')
<div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-pie-chart" aria-hidden="true"></i><a href="#">Charts</a></li>
            <li><a>ChartJS</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInUp">

    <div class="col-sm-12">
        <h4 class="section-subtitle text-center"><b>Chart.js</b></h4>
    </div>
    <div class="col-sm-8 col-sm-offset-2">
        <p class="section-text text-center  mb-xl">Simple yet flexible JavaScript charting for designers & developers. For more <a href="http://www.chartjs.org/">Info</a></p>
    </div>

    <!--LINE CHART-->
    <div class="col-sm-6 col-md-4">
        <h4 class="section-subtitle"><b>Line</b> Chart</h4>
        <div class="panel">
            <div class="panel-content">
                <canvas id="line-chart" width="400" height="260"></canvas>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--AREA CHART-->
    <div class="col-sm-6 col-md-4">
        <h4 class="section-subtitle"><b>Area</b> Chart</h4>
        <div class="panel">
            <div class="panel-content">
                <canvas id="area-chart" width="400" height="260"></canvas>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--BAR CHART-->
    <div class="col-sm-6 col-md-4">
        <h4 class="section-subtitle"><b>Bar</b> Chart</h4>
        <div class="panel">
            <div class="panel-content">
                <canvas id="bar-chart" width="400" height="260"></canvas>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--PIE CHART-->
    <div class="col-sm-6 col-md-4">
        <h4 class="section-subtitle"><b>Pie</b> Chart</h4>
        <div class="panel">
            <div class="panel-content">
                <canvas id="pie-chart" width="400" height="260"></canvas>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--DONUT CHART-->
    <div class="col-sm-6 col-md-4">
        <h4 class="section-subtitle"><b>Donut</b> Chart</h4>
        <div class="panel">
            <div class="panel-content">
                <canvas id="donut-chart" width="400" height="260"></canvas>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--POLAR CHART-->
    <div class="col-sm-6 col-md-4">
        <h4 class="section-subtitle"><b>Polar</b> Chart</h4>
        <div class="panel">
            <div class="panel-content">
                <canvas id="polar-chart" width="400" height="260"></canvas>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--RADAR CHART-->
    <div class="col-sm-6 col-md-4">
        <h4 class="section-subtitle"><b>Radar</b> Chart</h4>
        <div class="panel">
            <div class="panel-content">
                <canvas id="radar-chart" width="400" height="260"></canvas>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--RADAR CHART-->
    <div class="col-sm-6 col-md-4">
        <h4 class="section-subtitle"><b>Bubble</b> Chart</h4>
        <div class="panel">
            <div class="panel-content">
                <canvas id="bubble-chart" width="400" height="260"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script src="{{ asset('vendor/chart-js/chart.min.js') }}"></script>
    <script src="{{ asset('js/examples/charts/chart-js.js') }}"></script>
@stop
