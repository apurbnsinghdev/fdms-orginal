@extends('layouts.admin')
@section('title', 'Freezer')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="{{ route('inventoryreports.index') }}">Report </a></li>
            <li><a>DF Received & Delivery Summary</a></li>
        </ul>
    </div>
</div>
<div class="tabs">
    <ul class="nav nav-tabs">
        <li class="@if($param=='0'){{ 'active' }}@endif"><a href="{{ route('inventoryreports.index') }}">DF Received & Delivery</a></li>
        <li class="@if($param=='1'){{ 'active' }}@endif"><a href="{{ route('inventoryreports.index',[1]) }}">DF Received</a></li>
        <li class="@if($param=='2'){{ 'active' }}@endif"><a href="{{ route('inventoryreports.index',[2]) }}">DF Delivery</a></li>
    </ul>
</div>
<div class="row animated fadeInRight">
	 <div class="col-sm-12">
		{{ Form::open(['url'=>route('inventoryreports.index',[$param]),'method'=>'post','class'=>'form-horizontal']) }}
			<div class="panel">
	            <div class="panel-content">
					<div class="row">
						<div class="col-md-12">
							@if($param == 0)
	                    	<div class="form-group">
	                            {{Form::label('Report Range:',null,array('class' => 'control-label col-sm-2'))}}
	                            <div class="col-md-6">
	                                <div class="input-daterange input-group" id="year-range-datepicker">
	                                    {{Form::text('start_date', $start_date,array('class' => 'form-control input-sm', 'id'=>'startDate'))}}
	                                    <span class="input-group-addon x-primary">to</span>
	                                    {{Form::text('end_date', $end_date,array('class' => 'form-control input-sm','id'=>'endDate'))}}
	                                </div>
	                            </div>
	                        </div>
	                        @else
							<div class="form-group">
	                            {{Form::label('Date Range:',null,array('class' => 'control-label col-sm-2'))}}
	                            <div class="col-md-6">
	                                <div class="input-daterange input-group" id="date-range-datepicker">
	                                    {{Form::text('start_date', $start_date,array('class' => 'form-control input-sm', 'id'=>'startDate'))}}
	                                    <span class="input-group-addon x-primary">to</span>
	                                    {{Form::text('end_date', $end_date,array('class' => 'form-control input-sm','id'=>'endDate'))}}
	                                </div>
	                            </div>
	                        </div>

	                        @endif


					        <!--RANGE datepicker-->

							<div class="form-group">
		                        <div class="col-md-6 col-md-offset-2">
		                            <button type="submit" name="submit" value="search" class="btn btn-primary">
		                                Search
		                            </button>
		                        </div>
		                    </div>
				    	</div>
					</div>
				</div>
			</div>

	       	<h4 class="section-subtitle"><strong>DF Received & Delivery Summary</strong></h4>
	        <span class="pull-right">
	            <button type="submit" name="submit" value="download" class="btn btn-info">
	                <i class="fa fa-download" aria-hidden="true"></i> Excel
	            </button>
	        </span>

		{{Form::close()}}
		@if($param==0)
		@include('reports.inventory.receive_delivery.overall_report')
		@elseif($param==1)
		@include('reports.inventory.receive_delivery.received_report')
		@else
		@include('reports.inventory.receive_delivery.delivery_report')
		@endif
    </div>
</div>
@endsection

@component('common_pages.selectize')
    <script src="{{ asset('vendor/bootstrap_date-picker/js/bootstrap-datepicker.min.js') }}"></script>
<script>
$('#year-range-datepicker').datepicker({
 	format: "yyyy",
 	startDate: "2009",
 	endDate: "+0d",
 	autoclose: true,
 	viewMode: "years",
	minViewMode: "years",
 	todayHighlight: true,
 	todayBtn: "linked",
 });

$('#date-range-datepicker').datepicker({
    format: "dd-mm-yyyy",
    startDate: "01-01-2009",
    endDate: "+0d",
    weekStart: 1,
    todayBtn: "linked",
    todayHighlight: true,
    autoclose: true,
});
</script>
    @slot('css')
     <!--Date picker-->
     <link rel="stylesheet" href="{{ asset('vendor/bootstrap_date-picker/css/bootstrap-datepicker3.min.css') }}">
    @endslot
@endcomponent