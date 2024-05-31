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
<div class="row animated fadeInRight">
	 <div class="col-sm-12">
		{{ Form::open(['url'=>route('inventoryreports.index'),'method'=>'post','class'=>'form-horizontal']) }}
			<div class="panel">
	            <div class="panel-content">
					<div class="row">
						<div class="col-md-12">

							<div class="form-group{{ $errors->has('invoice_date') ? ' has-error' : '' }}">
		                        {{Form::label('Reporting_Year:',null,array('class' => 'control-label col-sm-2'))}}
		                        <div class="col-md-6">
		                            <div class="input-group">
		                                <span class="input-group-addon x-primary"><i class="fa fa-calendar"></i></span>
		                                {{Form::text('reporting_year',$reporting_year,array('class' => 'form-control datepicker'))}}
		                            </div>
		                        </div>
	                    	</div>

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

	       	<h4 class="section-subtitle"><strong>DF received & Delivary </strong></h4>
	        <span class="pull-right">
	            <button type="submit" name="submit" value="download" class="btn btn-info">
	                <i class="fa fa-download" aria-hidden="true"></i> Excel
	            </button>
	        </span>

		{{Form::close()}}
		@include('reports.inventory.index_report')
    </div>
</div>
@endsection

@component('common_pages.selectize')
    <script src="{{ asset('vendor/bootstrap_date-picker/js/bootstrap-datepicker.min.js') }}"></script>
    <script>

	    $('.datepicker').datepicker({
         	format: "yyyy",
         	viewMode: "years",
    		minViewMode: "years",
         	todayHighlight: true
         });

    </script>
    @slot('css')
     <!--Date picker-->
     <link rel="stylesheet" href="{{ asset('vendor/bootstrap_date-picker/css/bootstrap-datepicker3.min.css') }}">
    @endslot
@endcomponent