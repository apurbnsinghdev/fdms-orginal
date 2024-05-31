@extends('layouts.admin')
@section('title', 'Freezer')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="{{route('inventoryreports.getSizeWiseDFStatus')}}">Report </a></li>
            <li><a>Size Wise Retailer Deep Freeze status</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
	 <div class="col-sm-12">

		<div class="panel">
            <div class="panel-content">
				{{ Form::open(['url'=>route('inventoryreports.getSizeWiseDFStatus'),'method'=>'post', 'id'=>'size-wise-df-status', 'class'=>'form-horizontal']) }}

				{{ Form::hidden('is_download', '0', array('id' => 'is_download') ) }}
				<div class="row">
					<div class="col-md-12">
						<div class="form-group{{ $errors->has('invoice_date') ? ' has-error' : '' }}">
	                        {{Form::label('Reporting_Year:',null,array('class' => 'control-label col-sm-2 '))}}
	                        <div class="col-md-6">
	                            <div class="input-group">
	                                <span class="input-group-addon x-primary"><i class="fa fa-calendar"></i></span>
	                                {{Form::text('reporting_year',null,array('class' => 'form-control datepicker'))}}
	                            </div>
	                        </div>
                    	</div>

                    	<div class="form-group">
                                <label for="righticon" class="col-sm-2 control-label">Select Sizes</label>
                                <div class="col-sm-6">

                                	<div class="checkbox-custom checkbox-success">
                                        <input type="checkbox" id="checkboxCustom3" value="option1" onclick="$('input[name*=\'sizes\']').prop('checked', this.checked);" checked>
                                        <label class="check" for="checkboxCustom3">Select All</label>
                                    </div>

                                 	@foreach ($sizes as $key=>$size)

                                    <div class="checkbox-custom checkbox-inline checkbox-primary">
                                        <input type="checkbox" id="checkboxCustom1{{$key}}" name="sizes[]" value="{{$key}}" {!! in_array($key,$selectedSizes->flip()->toArray())?'checked ': ''!!}>
                                        <label class="check" for="checkboxCustom1{{$key}}">{{$size}}</label>
                                    </div>
                                    @endforeach
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
			</form>
			</div>
		</div>
       	<h4 class="section-subtitle"><b>Size Wise Retailer Deep Freeze - 2018</b></h4>
        <span class="pull-right">
        	<button type="submit" class="btn btn-info" onClick="$('#is_download').val(1); $('#size-wise-df-status').submit();">
	            <i class="fa fa-download" aria-hidden="true"></i>
	        </button>
        </span>
		@include('reports.inventory.size_wise_df_status_report')
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
         	todayHighlight: true,
            autoclose: true,
         }).datepicker("setDate",'now');
    </script>
    @slot('css')
     <!--Date picker-->
     <link rel="stylesheet" href="{{ asset('vendor/bootstrap_date-picker/css/bootstrap-datepicker3.min.css') }}">
    @endslot
@endcomponent