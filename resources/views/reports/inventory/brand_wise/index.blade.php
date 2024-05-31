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

                        <!--RANGE datepicker-->
                        <div class="form-group">
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

                                <div class="form-group">
                                    {{Form::label('depot:',null,array('class' => 'control-label col-sm-2'))}}
                                    <div class="col-md-6">
                                        {{Form::select('depotIds[]',$depots->toArray(),$depotIds,array('class' => 'form-control','id'=>'multiselect-depot-select2', 'multiple'=>true))}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {{Form::label('Distributor:',null,array('class' => 'control-label col-sm-2'))}}
                                    <div class="col-md-6">
                                        <span id="shop-list">{{Form::select('distributorIds[]',[],null,array('class' => 'form-control','id'=>'multiselect-distributor-select2', 'multiple'=>true))}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{Form::label('Division:',null,array('class' => 'control-label col-sm-2'))}}
                                        <div class="col-md-8">
                                            {{Form::select('divisionIds[]',$divisions->toArray(),$divisionIds,array('class' => 'form-control', 'id'=>'multiselect-division-select2','multiple'=>true))}}

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {{Form::label('District:',null,array('class' => 'control-label col-sm-2'))}}
                                        <div class="col-md-8">
                                            {{Form::select('districtIds[]',[],null,array('class' => 'form-control', 'id'=>'multiselect-district-select2','multiple'=>true))}}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {{Form::label('Thana:',null,array('class' => 'control-label col-sm-2'))}}
                                        <div class="col-md-8">
                                            {{Form::select('thanaIds[]',[],null,array('class' => 'form-control', 'id'=>'multiselect-thana-select2','multiple'=>true))}}
                                        </div>
                                    </div>
                                     <hr class="hidden-lg hidden-md">
                                </div>
                            </div>
                        @endif
                        <br />
						<div class="form-group">
	                        <div class="col-md-6 col-md-offset-2">
	                            <button type="submit" class="btn btn-primary" onClick="$('#is_download').val(0);">
	                                Search
	                            </button>
	                        </div>
	                    </div>
			    	</div>
				</div>
			</form>
			</div>
		</div>
@if($is_post)
        <span class="pull-right">
        	<button type="submit" class="btn btn-info" onClick="$('#is_download').val(1); $('#brand-wise-df-status').submit();">
	            <i class="fa fa-download" aria-hidden="true"></i>
	        </button>
        </span>

        <h4 class="section-subtitle"><b>Brand Wise Deep Freeze {{$start_date.' to '.$end_date}}</b></h4>

        @if($param ==0)

        @include('reports.inventory.brand_wise.region_report')
        @elseif($param ==1)
            @include('reports.inventory.brand_wise.location_report')
        @else
            @include('reports.inventory.brand_wise.depot_report')
        @endif
@endif

    </div>
</div>

@endsection

@component('common_pages.selectize')
@include('common_pages.max_length')
<script src="{{ asset('vendor/bootstrap_date-picker/js/bootstrap-datepicker.min.js') }}"></script>
<script>

     $('.datepicker').datepicker({
     	format: "yyyy",
     	viewMode: "years",
		minViewMode: "years",
     	todayHighlight: true,
        autoclose: true,
     });
    //.datepicker("setDate",'now');

    //Range datepicker example
    $('#area-range-datepicker').datepicker({
        format: "dd-mm-yyyy",
        weekStart: 1,
        todayBtn: "linked",
        todayHighlight: true,
        autoclose: true,
    });
    /*Multi Depot Start */
    @if(isset($depotIds) && !isset($distributorIds))
        var depotIds =  @json($depotIds);
        populateDistributor(1, depotIds);
    @endif

    @if(isset($depotIds) && isset($distributorIds))
        var depotIds =  @json($depotIds);
        var distributorIds =  @json($distributorIds);
        populateDistributor(1, depotIds, distributorIds);
    @endif

    $("#multiselect-distributor-select2").select2({
        placeholder : "Please Select Distributors",
        allowClear: true,
    });

    $("#multiselect-depot-select2").select2({
        placeholder : "Please Select Depots",
        allowClear: true,
    });
    $('#multiselect-depot-select2').on('select2:select', function (e) {

        var distributorIds = $('#multiselect-distributor-select2').val();
        var depotIds = $(this).val();
        populateDistributor(1, depotIds, distributorIds);
    });

    $('#multiselect-depot-select2').on('select2:unselect', function (e) {
        var depotIds = $(this).val();
        var distributorIds = $('#multiselect-distributor-select2').val();
        populateDistributor(1, depotIds, distributorIds);

    });

    function populateDistributor(multiple = 0, depotIds, distributorIds=[]){

        if(depotIds.length > 0){

            if(multiple){
                var depotIds = depotIds;
            }else{
                var depotIds = depotIds[depotIds.length - 1];
            }

            $.ajax({
              type: 'POST',
              url:"{{ route('ajax.getMultiDistributor') }}",
              data:{depotIds:depotIds,multiple:multiple, _token: '{{csrf_token()}}'}
            }).done(function(response) {
                $('#multiselect-distributor-select2').children().remove("optgroup");
                var select = document.getElementById("multiselect-distributor-select2");
                for(res in response){
                    var optG = document.createElement("optgroup");
                    var responseObj = response[res];
                    var distributorObj = response[res].distributors;
                    optG.label = responseObj.name;
                    if(distributorObj.length >0){
                        for(d in distributorObj){
                            optG.appendChild(new Option(distributorObj[d].outlet_name, distributorObj[d].id));
                        }
                    }
                    select.appendChild(optG);

                }

                if(distributorIds.length > 0){
                    $('#multiselect-distributor-select2').val(distributorIds);
                    $('#multiselect-distributor-select2').trigger('change');
                }

            }).fail(function(response) {
                console.log(response);
            });



        }else{
            $('#multiselect-distributor-select2').children().remove("optgroup");
        }
    }


    /*Multi District Start */

    $("#multiselect-division-select2").select2({
        placeholder : "Please Select Divisons",
        allowClear: true,
    });


    $('#multiselect-division-select2').on('select2:select', function (e) {

        var districtIds = $('#multiselect-district-select2').val();
        var divisionIds = $(this).val();
        populateDistricts(1, divisionIds, districtIds);
    });

    $('#multiselect-division-select2').on('select2:unselect', function (e) {

        var divisionIds = $(this).val();

        var districtIds = $('#multiselect-district-select2').val();

        populateDistricts(1, divisionIds, districtIds);

    });

    $('#multiselect-division-select2').on('select2:close', function (e) {

        var districtIds = $('#multiselect-district-select2').val();
        var thanaIds = $('#multiselect-thana-select2').val();
        if(districtIds.length>0 && thanaIds.length > 0){
            populateThanas(1, districtIds, thanaIds);
        }
    });

    @if(isset($divisionIds) && !isset($districtIds))
        var divisionIds =  @json($divisionIds);
        populateDistricts(1, divisionIds);
    @endif

    @if(isset($districtIds) && isset($divisionIds))
        var divisionIds =  @json($divisionIds);
        var districtIds =  @json($districtIds);
        populateDistricts(1, divisionIds, districtIds);
    @endif

    @if(isset($thanaIds) && isset($districtIds))
        var districtIds =  @json($districtIds);
        var thanaIds =  @json($thanaIds);
        populateThanas(1, districtIds, thanaIds);
    @endif

    function populateDistricts(multiple = 0, divisionIds, districtIds=[]){

        if(divisionIds.length > 0){

            if(multiple){
                var divisions = divisionIds;
            }else{
                var divisions = divisionIds[divisionIds.length - 1];
            }

            $.ajax({
              type: 'POST',
              url:"{{ route('ajax.getMultiDistricts') }}",
              data:{divisionIds:divisions,multiple:multiple, _token: '{{csrf_token()}}'}
            }).done(function(response) {
                $('#multiselect-district-select2').children().remove("optgroup");
                var select = document.getElementById("multiselect-district-select2");
                for(res in response){
                    var optG = document.createElement("optgroup");
                    var responseObj = response[res];
                    var districtObj = response[res].children;
                    optG.label = responseObj.name;
                    for(d in districtObj){
                        optG.appendChild(new Option(districtObj[d].name, districtObj[d].id));
                    }
                    select.appendChild(optG);

                }

                if(districtIds.length > 0){
                    $('#multiselect-district-select2').val(districtIds);
                    $('#multiselect-district-select2').trigger('change');
                }

            }).fail(function(response) {
                console.log(response);
            });



        }else{
            $('#multiselect-district-select2').children().remove("optgroup");
            $('#multiselect-thana-select2').children().remove("optgroup");
        }
    }

    /*Multi District End */

    /*MultiThana Start */
    $("#multiselect-district-select2").select2({
        placeholder : "Please Select Districts",
        allowClear: true,
    });

     $('#multiselect-district-select2').on('select2:select', function (e) {
        var thanaIds = $('#multiselect-thana-select2').val();
        var districtIds = $(this).val();
        populateThanas(1, districtIds, thanaIds);
    });

    $('#multiselect-district-select2').on('select2:unselect', function (e) {

        var districtIds = $(this).val();
        var thanaIds = $('#multiselect-thana-select2').val();
        populateThanas(1, districtIds, thanaIds);
    });

    $('#multiselect-district-select2').on('select2:close', function (e) {

        //$('#multiselect-thana-select2').children().remove("optgroup");

    });

    function populateThanas(multiple = 0, districtIds, thanaIds=[]){

        if(districtIds.length > 0){

            if(multiple){
                var districts = districtIds;
            }else{
                var districts = districtIds[districtIds.length - 1];
            }

            $.ajax({
              type: 'POST',
              url:"{{ route('ajax.getMultiThanas') }}",
              data:{districtIds:districts,multiple:multiple, _token: '{{csrf_token()}}'}
            }).done(function(response) {
                $('#multiselect-thana-select2').children().remove("optgroup");
                var select = document.getElementById("multiselect-thana-select2");
                for(res in response){
                    var optG = document.createElement("optgroup");
                    var responseObj = response[res];
                    var districtObj = response[res].children;
                    optG.label = responseObj.name;
                    for(d in districtObj){
                        optG.appendChild(new Option(districtObj[d].name, districtObj[d].id, false, false));
                    }

                    select.appendChild(optG)

                    if(thanaIds.length > 0){
                        console.log(thanaIds);
                        $('#multiselect-thana-select2').val(thanaIds);
                        $('#multiselect-thana-select2').trigger('change');
                    }
                }

            }).fail(function(response) {
                console.log(response);
            });
        }else{
            $('#multiselect-thana-select2').children().remove("optgroup");
        }
    }

    /*multi Thana End */

    $("#multiselect-thana-select2").select2({
        placeholder : "Please Select Thanas",
        allowClear: true,
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
        placeholder : "Please Select Regions",
        allowClear: true,
    });

</script>
@slot('css')
 <!--Date picker-->
 <link rel="stylesheet" href="{{ asset('vendor/bootstrap_date-picker/css/bootstrap-datepicker3.min.css') }}">
@endslot
@endcomponent