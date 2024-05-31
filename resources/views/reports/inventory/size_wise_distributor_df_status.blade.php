@extends('layouts.admin')
@section('title', 'Freezer')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Report </a></li>
            <li><a>Size Wise Distributor Deep Freeze status</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
	 <div class="col-sm-12">

		<div class="panel">
            <div class="panel-content">
				{{ Form::open(['url'=>route('inventoryreports.getSizeWiseDistributorDFStatus'),'method'=>'post', 'id'=>'size-wise-distributor-df-status','class'=>'form-horizontal']) }}
				{{ Form::hidden('is_download', '0', array('id' => 'is_download') ) }}
				<div class="row">
					<div class="col-md-12">
				        <div class="form-group{{ $errors->has('reporting_year') ? ' has-error' : '' }}">
	                        {{Form::label('Reporting_Year:',null,array('class' => 'control-label col-sm-2'))}}
	                        <div class="col-md-6">
	                            <div class="input-group">
	                                <span class="input-group-addon x-primary"><i class="fa fa-calendar"></i></span>
	                                {{Form::text('reporting_year',null,array('class' => 'form-control datepicker'))}}
	                            </div>
	                        </div>
                    	</div>
                    	<div class="form-group">
                            {{Form::label('Select Sizes:',null,array('class' => 'control-label col-sm-2'))}}
                            <div class="col-md-8">
                                {{Form::select('sizes[]', $sizes->toArray(), $sizeIds ,array('class' => 'select2 form-control','id'=>'multiselect-size-select2', 'multiple'=>true))}}

                            </div>
                        </div>
						<div class="form-group">
	                        <div class="col-md-6 col-md-offset-2">
	                            <button type="submit" class="btn btn-primary">
	                                Search
	                            </button>
	                        </div>
	                    </div>
			    	</div>
				</div>
			</div>
		</div>


       	<h4 class="section-subtitle"><b>Size Wise Distributor Deep Freeze - {{$reporting_year}}</b></h4>
        <span class="pull-right">
        	<button type="submit" class="btn btn-info" onClick="$('#is_download').val(1); $('#size-wise-distributor-df-status').submit();">
	            <i class="fa fa-download" aria-hidden="true"></i>
	        </button>
        </span>

		@include('reports.inventory.size_wise_distributor_df_status_report')

    </div>
</div>
@endsection

@component('common_pages.selectize')
<script src="{{ asset('vendor/bootstrap_date-picker/js/bootstrap-datepicker.min.js') }}"></script>
<script>
	 var currentDate = new Date();
	 	 currentDate.setYear(<?php echo $reporting_year; ?>);

     $('.datepicker').datepicker({
     	format: "yyyy",
     	viewMode: "years",
		minViewMode: "years",
     	todayHighlight: true,
     }).datepicker("setDate", currentDate);

     $("#multiselect-size-select2").select2({
        placeholder : "Please Select Brands",
        allowClear: true,
    });
</script>
@slot('css')
<!--Date picker-->
<link rel="stylesheet" href="{{ asset('vendor/bootstrap_date-picker/css/bootstrap-datepicker3.min.css') }}">
@endslot
@endcomponent