@extends('layouts.admin')
@section('title', 'Freezer')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Report </a></li>
            <li><a>Region wise Freeze status</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
	 <div class="col-sm-12">

		<div class="panel">
            <div class="panel-content">
				{{ Form::open(['url'=>route('inventoryreports.index'),'method'=>'post','class'=>'form-horizontal']) }}
				<div class="row">
					<div class="col-md-12">
						<div class="form-group{{ $errors->has('region_id') ? ' has-error' : '' }}">
							{{Form::label('Region:',null,array('class' => 'control-label col-sm-2 require'))}}
							 <div class="col-md-6">
							 	<?php $regions[''] = 'Please Select';?>
								{{Form::select('region_id',$regions,old('region_id',''),array('class' => 'form-control'))}}
				                {!! $errors->first('region_id', '<p class="text-danger">:message</p>' ) !!}
							</div>
						</div>
				        <!--RANGE datepicker-->
                        <div class="form-group{{ $errors->has('range') ? ' has-error' : '' }}">
                            {{Form::label('Range:',null,array('class' => 'control-label col-sm-2 require'))}}
                            <div class="col-md-6">
                                <div class="input-daterange input-group" id="area-range-datepicker">
                                	{{Form::text('start_date',date("d/m/Y"),array('class' => 'form-control input-sm', 'id'=>'startDate'))}}
                                    <span class="input-group-addon x-primary">to</span>
                                    {{Form::text('finish_date',date("d/m/Y", strtotime('tomorrow')),array('class' => 'form-control input-sm','id'=>'finishDate'))}}
                                </div>
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


       	<h4 class="section-subtitle"><b>Freezer received, Delivary & Stoke In Hand status of Dhaka South</b></h4>
        <span class="pull-right">
          	{!! Form::open(['url'=>route('inventoryreports.index'),'method'=>'post','class'=>'form-inline-block'])
               . Form::button('<i class="fa fa-download" aria-hidden="true"></i> Excel', ['type'=>'submit','class'=>'btn btn-info'])
               .Form::close() !!}
        </span>


        <div class="panel">
			<div class="panel-content">
				<div class="table-responsive-xl">
				    <table class="table table-bordered table-striped table-sm">
				        <thead class="table-primary">
				            <tr>
				                <td rowspan="2"><p>SL NO.</p></td>
				                <td rowspan="2"><p>Date</p></td>
				                <td rowspan="2"><p>Brand Name</p></td>
				                <td rowspan="2"><p>Code</p></td>
				                <td colspan="4"><p align="center">Opening Balance</p></td>
				                <td colspan="4"><p align="center">Size (Received)</p></td>
				                <td colspan="4"><p align="center">Delivary</p></td>
				                <td colspan="4"><p align="center">Closing Stoke In Hanf</p></td>
				                <td valign="middle" rowspan="2"><p>Remarks</p></td>
				            </tr>
				            <tr>
				                <td><p>115</p></td>
				                <td><p>270</p></td>
				                <td><p>341</p></td>
				                <td><p>Total</p></td>
				                <td><p>115</p></td>
				                <td><p>270</p></td>
				                <td><p>341</p></td>
				                <td><p>Total</p></td>
				                <td><p>115</p></td>
				                <td><p>270</p></td>
				                <td><p>341</p></td>
				                <td><p>Total</p></td>
				                <td><p>115</p></td>
				                <td><p>270</p></td>
				                <td><p>341</p></td>
				                <td><p>Total</p></td>
				            </tr>
				        </thead>
				        <tbody>
				            <tr>
				                <td><p>1</p></td>
				                <td><p>11.01.17</p></td>
				                <td><p>LR</p></td>
				                <td><p>0</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				            </tr>
				            <tr>
				                <td><p>2</p></td>
				                <td><p>11.01.17</p></td>
				                <td><p>LR</p></td>
				                <td><p>0</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				            </tr>
				            <tr>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				            </tr>
				            <tr>
				                <td width="194" colspan="3"><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				                <td><p>&nbsp;</p></td>
				            </tr>
				        </tbody>
				    </table>
				</div>
            </div>
        </div>
    </div>
</div>
@endsection

@component('common_pages.selectize')
    <script src="{{ asset('vendor/bootstrap_date-picker/js/bootstrap-datepicker.min.js') }}"></script>
    <script>
        //Range datepicker example
	    $('#area-range-datepicker').datepicker({
	        format: "dd/mm/yy",
	        weekStart: 1,
	        todayBtn: "linked",
	        todayHighlight: true
	    });


    </script>
    @slot('css')
     <!--Date picker-->
     <link rel="stylesheet" href="{{ asset('vendor/bootstrap_date-picker/css/bootstrap-datepicker3.min.css') }}">
    @endslot
@endcomponent