@extends('layouts.admin')
@section('title', 'Freezer')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="{{route('inventoryreports.getSizeWiseDFStatus')}}">Report </a></li>
            <li><a>Brand Wise Deep Freeze status</a></li>
        </ul>
    </div>
</div>
<div class="tabs">
    <ul class="nav nav-tabs">
        <li class="@if($param=='0'){{ 'active' }}@endif"><a href="{{ route('inventoryreports.getBrandWiseDFStatus') }}">Region Wise Search</a></li>
        <li class="@if($param=='1'){{ 'active' }}@endif"><a href="{{ route('inventoryreports.getBrandWiseDFStatus',[1]) }}">Location Wise Search</a></li>
        <li class="@if($param=='2'){{ 'active' }}@endif"><a href="{{ route('inventoryreports.getBrandWiseDFStatus',[2]) }}">Depot Wise Search</a></li>
    </ul>
</div>
<div class="row animated fadeInRight">
	 <div class="col-sm-12">
		<div class="panel">
            <div class="panel-content">
			{{ Form::open(['url'=>route('inventoryreports.getBrandWiseDFStatus',[$param]),'method'=>'post', 'id'=>'brand-wise-df-status', 'class'=>'form-horizontal']) }}

				{{ Form::hidden('is_download', '0', array('id' => 'is_download') ) }}
				<div class="row">
					<div class="col-md-12">
                        <!--
						<div class="form-group">
	                        {{Form::label('Reporting_Year:',null,array('class' => 'control-label col-sm-2 '))}}
	                        <div class="col-md-6">
	                            <div class="input-group">
	                                <span class="input-group-addon x-primary"><i class="fa fa-calendar"></i></span>
	                                {{Form::text('reporting_year',$start_date,array('class' => 'form-control datepicker'))}}
	                            </div>
	                        </div>
                    	</div>
                        -->

                        <!--RANGE datepicker-->
                        <div class="form-group{{ $errors->has('range') ? ' has-error' : '' }}">
                            {{Form::label('Date Range:',null,array('class' => 'control-label col-sm-2'))}}
                            <div class="col-md-6">
                                <div class="input-daterange input-group" id="area-range-datepicker">
                                    {{Form::text('start_date',$start_date,array('class' => 'form-control input-sm', 'id'=>'startDate'))}}
                                    <span class="input-group-addon x-primary">to</span>
                                    {{Form::text('end_date', $end_date,array('class' => 'form-control input-sm','id'=>'endDate'))}}
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('Select Brands:',null,array('class' => 'control-label col-sm-2'))}}
                            <div class="col-md-8">
                                {{Form::select('brands[]', $brands->toArray(), $brandIds ,array('class' => 'select2 form-control','id'=>'multiselect-brand-select2', 'multiple'=>true))}}
                            </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('Select Sizes:',null,array('class' => 'control-label col-sm-2'))}}
                            <div class="col-md-8">
                                {{Form::select('sizes[]', $sizes->toArray(), $sizeIds ,array('class' => 'select2 form-control','id'=>'multiselect-size-select2', 'multiple'=>true))}}

                            </div>
                        </div>

                        @if($param == 0)
                        <div class="form-group">
                            {{Form::label('Region:',null,array('class' => 'control-label col-sm-2'))}}
                            <div class="col-md-8">
                                {{Form::select('regions[]',$regions->toArray(), $regionIds, array('class' => 'select2 form-control','id'=>'multiselect-region-select2', 'multiple'=>true))}}
                            </div>
                        </div>
                        @elseif($param == 2)
                        <div class="row mb-md">
                            <div class="col-md-12">
                                @if ($depots->isEmpty() && !empty($depotId))
                                    {{ Form::hidden('depot_id',$depotId) }}
                                @else
                                    <div class="form-group{{ $errors->has('depot_id') ? ' has-error' : '' }}">
                                        {{Form::label('depot:',null,array('class' => 'control-label col-sm-2'))}}
                                        <div class="col-md-6">
                                            {{Form::select('depot_id',[''=>'Please Select Depot']+$depots->toArray(),null,array('class' => 'form-control select2','data-placeholder'=>'Please Select Depot','onchange'=>'getExecutiveDepotShop(this.value)'))}}
                                            {!! $errors->first('depot_id', '<p class="text-danger">:message</p>' ) !!}
                                        </div>
                                    </div>
                                @endif

                                <div class="form-group{{ $errors->has('distributor_id') ? ' has-error' : '' }}" v-show="!isDistributor">
                                    {{Form::label('Distributor:',null,array('class' => 'control-label col-sm-2'))}}
                                    <div class="col-md-6">
                                        <span id="shop-list">{{Form::select('distributor_id',[''=>'Please Select Distributor']+$distributors->toArray(),null,array('class' => 'form-control select2','data-placeholder'=>'Please Select Distributor'))}}</span>
                                        {!! $errors->first('distributor_id', '<p class="text-danger">:message</p>' ) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('division_id') ? ' has-error' : '' }}">
                                        {{Form::label('Division:',null,array('class' => 'control-label col-sm-4'))}}
                                        <div class="col-md-8">
                                            {{Form::select('division_id',['0'=>'Please Select Division']+$divisions->toArray(),null,array('class' => 'form-control','v-model'=>'division_id', '@change'=>'getDistricts'))}}
                                            {!! $errors->first('division_id', '<p class="text-danger">:message</p>' ) !!}
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('district_id') ? ' has-error' : '' }}">
                                        {{Form::label('District:',null,array('class' => 'control-label col-sm-4'))}}
                                        <div class="col-md-8">
                                            <select name="district_id" class="form-control col-sm-2" v-model="district_id" @change="getThanas">
                                                <option value="0">Please Select District</option>
                                                <option v-for="(name,id) in districts" v-bind:value="id" v-text="name"></option>
                                            </select>
                                            {!! $errors->first('district_id', '<p class="text-danger">:message</p>' ) !!}
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('thana_id') ? ' has-error' : '' }}">
                                        {{Form::label('Thana:',null,array('class' => 'control-label col-sm-4'))}}
                                        <div class="col-md-8">
                                            <select name="thana_id" v-model="thana_id" class="form-control col-sm-2">
                                                <option value="0">Please Select Thana</option>
                                                <option v-for="(name,id) in thanas" v-bind:value="id" v-text="name"></option>
                                            </select>
                                            {!! $errors->first('thana_id', '<p class="text-danger">:message</p>' ) !!}
                                        </div>
                                    </div>
                                     <hr class="hidden-lg hidden-md">
                                </div>
                            </div>
                        @endif
                        <br />
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

        <span class="pull-right">
        	<button type="submit" class="btn btn-info" onClick="$('#is_download').val(1); $('#size-wise-df-status').submit();">
	            <i class="fa fa-download" aria-hidden="true"></i>
	        </button>
        </span>

        <h4 class="section-subtitle"><b>Brand Wise Deep Freeze {{$start_date.' to '.$end_date}}</b></h4>

        @if($param ==0)

        @include('reports.inventory.region_wise_brand_df_status_report')
        @elseif($param ==1)
            @include('reports.inventory.location_wise_brand_df_status_report')
        @else
            @include('reports.inventory.depot_wise_brand_df_status_report')
        @endif

    </div>
</div>
@endsection
@section('vuescript')
<script>
    laravelObj.division_id='0';
    laravelObj.district_id='{{ old('district_id') }}';
    laravelObj.thana_id='{{ old('thana_id') }}';
    laravelObj.region_id='{{ old('region_id') }}';
    laravelObj.area_id='{{ old('area_id') }}';
</script>
@stop
@component('common_pages.selectize')
@include('common_pages.max_length')
<script src="{{ asset('vendor/bootstrap_date-picker/js/bootstrap-datepicker.min.js') }}"></script>
<script>
     //get shops or distributor
        function getExecutiveDepotShop(depotId){
            $('#shop-list').html('');
            $.ajax({
              type: 'Get',
              url:"{{ route('ajax.getShops') }}",
              data:{depot_id:depotId,distributor:1}
            }) .done(function(response) {
             $('#shop-list').html(response);
           //Select2 basic example
             $.fn.select2.defaults.set( "theme", "bootstrap" );
              $(".select2").select2({
                 // placeholder: function(){
                 //     $(this).data('placeholder');
                 // },
                 allowClear: true
             });
            if('{{old('shop_id')}}'){
                $("#shop_id").val('{{old('shop_id')}}').change();
            }

          })
          .fail(function(response) {
          });
        }


     $('.datepicker').datepicker({
     	format: "yyyy",
     	viewMode: "years",
		minViewMode: "years",
     	todayHighlight: true
     });
    //.datepicker("setDate",'now');

    //Range datepicker example
    $('#area-range-datepicker').datepicker({
        format: "dd-mm-yyyy",
        weekStart: 1,
        todayBtn: "linked",
        todayHighlight: true
    });

    $("#multiselect-brand-select2").select2({
        placeholder : "Please Select Brands",
        allowClear: true,
    });

    $("#multiselect-size-select2").select2({
        placeholder : "Please Select Sizes",

        allowClear: true,
    });

    $("#multiselect-region-select2").select2({
        placeholder : "Please Select regions",
        allowClear: true,
    });

</script>
@slot('css')
 <!--Date picker-->
 <link rel="stylesheet" href="{{ asset('vendor/bootstrap_date-picker/css/bootstrap-datepicker3.min.css') }}">
@endslot
@endcomponent