@extends('layouts.admin')
@section('title', 'Freezer')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="{{route('servicereports.index')}}">Service Report </a></li>
            <li><a href="{{route('servicereports.typeWiseComplain')}}">Type Wise Complain</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
	 <div class="col-sm-12">
		<div class="panel">
            <div class="panel-content">
			{{ Form::open(['url'=>route('servicereports.typeWiseComplain'),'method'=>'post', 'id'=>'brand-wise-df-status', 'class'=>'form-horizontal']) }}
            {{ Form::hidden('is_download',0, array('id' => 'is_download') ) }}
				<div class="row">
					<div class="col-md-12">
                        <!--Year-->
                        <div class="form-group">
                            {{Form::label('Select Year:',null,array('class' => 'control-label col-sm-2'))}}
                            <div class="col-md-8">
                                {{Form::selectYear('years[]', 2009, 2050, $years,  array('class' => 'select2 form-control','id'=>'year-select2', 'multiple'=>true))}}
                            </div>
                        </div>
                        <!--Month-->
                        <div class="form-group">
                            {{Form::label('Select Month:',null,array('class' => 'control-label col-sm-2'))}}
                            <div class="col-md-8">
                                {{Form::selectMonth('months[]', $months, array('class' => 'select2 form-control','id'=>'month-select2', 'multiple'=>true))}}
                            </div>
                        </div>
						<!--Region-->
                        <div class="form-group">
                            {{Form::label('Region:',null,array('class' => 'control-label col-sm-2'))}}
                            <div class="col-md-8">
                                {{Form::select('regionIds[]',$regions->toArray(), $regionIds, array('class' => 'select2 form-control','id'=>'region-select2', 'multiple'=>true))}}
                            </div>
                        </div>
						<!--Depots-->
                        <div class="form-group">
                            {{Form::label('depot:',null,array('class' => 'control-label col-sm-2'))}}
                            <div class="col-md-8">
                                {{Form::select('depotIds[]',$depots,$depotIds,array('class' => 'form-control','id'=>'depot-select2', 'multiple'=>true))}}
                            </div>
                        </div>


                        <!--Type Code-->
                        <div class="form-group">
                            {{Form::label('Problem Types:',null,array('class' => 'control-label col-sm-2'))}}

                            <div class="col-md-8">
                                {{Form::select('typeIds[]',$problemTypes, $typeIds,array('class' => 'form-control','id'=>'type-select2', 'multiple'=>true))}}
                            </div>
                        </div>

						<div class="form-group">
	                        <div class="col-md-8 col-md-offset-2">
	                            <button type="submit" class="btn btn-primary" onClick="$('#is_download').val(0);">
	                                Search Complain
	                            </button>
	                        </div>
	                    </div>
			    	</div>
				</div>
			</form>
			</div>
		</div>
		@if(isset($is_download))
    		<span class="pull-right">
            	<button type="submit" class="btn btn-info" onClick="$('#is_download').val(1); $('#brand-wise-df-status').submit();">
    	            <i class="fa fa-download" aria-hidden="true"></i>
    	        </button>
            </span>

            <h4 class="section-subtitle"><b>Type Wise Complain Report</b></h4>
            @include('reports.services.type_wise_complain_report')
        @endif
    </div>
</div>
@endsection

@component('common_pages.selectize')
<script src="{{ asset('vendor/bootstrap_date-picker/js/bootstrap-datepicker.min.js') }}"></script>
<script>
//Range datepicker example
$("#year-select2").select2({
    placeholder : "Please Select Years",
    allowClear: true,
});

$("#month-select2").select2({
    placeholder : "Please Select Months",
    allowClear: true,
});

$("#region-select2").select2({
    placeholder : "Please Select Regions",
    allowClear: true,
});

$("#depot-select2").select2({
    placeholder : "Please Select Depots",
    allowClear: true,
});

$("#dfcode-select2").select2({
    placeholder : "Please Select DF Codes",
    allowClear: true,
});

$("#type-select2").select2({
    placeholder : "Please Select Problem Types",
    allowClear: true,
});

$('#region-select2').on('select2:select', function (e) {

    var depotIds = $('#depot-select2').val();
    var regionIds = $(this).val();
    populateDepots(1, regionIds, depotIds);
    populateDfCodes(1, regionIds, depotIds);
});

$('#region-select2').on('select2:unselect', function (e) {

    var regionIds = $(this).val();
    var depotIds = $('#depot-select2').val();
    populateDepots(1, regionIds, depotIds);
});

$('#region-select2').on('select2:close', function (e) {

    var depotIds = $('#depot-select2').val();
    var codeIds = $('#dfcode-select2').val();
    var regionIds = $(this).val();
    if(depotIds.length>0 && codeIds.length > 0){
        populateDfCodes(1, regionIds, depotIds, codeIds);
    }
});

$('#depot-select2').on('select2:select', function (e) {

    var codeIds = $('#dfcode-select2').val();
    var regionIds = $('#region-select2').val();
    var depotIds = $(this).val();
    populateDfCodes(1, regionIds, depotIds, codeIds);
});

$('#depot-select2').on('select2:unselect', function (e) {

    var regionIds = $('#region-select2').val();
    var codeIds = $('#dfcode-select2').val();
    var depotIds = $(this).val();
    if(depotIds.length > 0){
    	populateDfCodes(1, regionIds, depotIds, codeIds);
	}else{
		$('#dfcode-select2').children().remove("optgroup");
	}
});
function populateDepots(multiple = 0, regionIds, depotIds=[]){

    if(regionIds.length > 0){

        if(multiple){
            var regionIds = regionIds;
        }else{
            var regionIds = regionIds[regionIds.length - 1];
        }

        $.ajax({
          type: 'POST',
          url:"{{ route('ajax.getRegionWiseDepots') }}",
          data:{regionIds:regionIds,multiple:multiple, _token: '{{csrf_token()}}'}
        }).done(function(response) {
            $('#depot-select2').children().remove("optgroup");
            var select = document.getElementById("depot-select2");

            for(k in response){
            	var optG = document.createElement("optgroup");
            	optG.label = k;
            	for(i in response[k]){
                	optG.appendChild(new Option(response[k][i], i));
            	}

            	select.appendChild(optG);
            }



            if(depotIds.length > 0){
                $('#depot-select2').val(depotIds);
                $('#depot-select2').trigger('change');
            }

        }).fail(function(response) {
            console.log(response);
        });
    }else{
        $('#depot-select2').children().remove("optgroup");
    }
}


</script>
@slot('css')
 <!--Date picker-->
 <link rel="stylesheet" href="{{ asset('vendor/bootstrap_date-picker/css/bootstrap-datepicker3.min.css') }}">
@endslot
@endcomponent