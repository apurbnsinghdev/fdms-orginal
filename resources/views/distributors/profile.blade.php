@extends('layouts.admin')
@section('title', 'Freezer')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="{{route('distributors.showProfile')}}">Report </a></li>
            <li><a>Token Search</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
	 <div class="col-sm-12">
		<div class="panel">
            <div class="panel-content">
			{{ Form::open(['url'=>route('distributors.showProfile'),'method'=>'post', 'id'=>'service-from', 'class'=>'form-horizontal']) }}

				{{ Form::hidden('is_download', '0', array('id' => 'is_download') ) }}
				<div class="row">
					<div class="col-md-12">

                        <!--RANGE datepicker-->
                        <div class="form-group{{ $errors->has('profileId') ? ' has-error' : '' }}">
                            {{Form::label('Profile ID:',null,array('class' => 'control-label col-sm-2 require'))}}
                            <div class="col-md-6">
                                {{Form::select('profileId', [''=>'Please Select Distributor']+$distributors->toArray(), $profileId  ,array('class' => 'select2 form-control','id'=>'distributor-select2'))}}
                                {!! $errors->first('profileId', '<p class="text-danger">:message</p>' ) !!}
                            </div>
                        </div>


						<div class="form-group">
	                        <div class="col-md-6 col-md-offset-2">
	                            <button type="submit" class="btn btn-primary" onClick="$('#is_download').val(0);">
	                                Search Distributor
	                            </button>
	                        </div>
	                    </div>
			    	</div>
				</div>
			</form>
			</div>
		</div>
		@if(isset($is_download))

		@if($profile AND $profile->count()>0)
		<span class="pull-right">
        	<button type="submit" class="btn btn-info" onClick="$('#is_download').val(1); $('#service-from').submit();">
	            <i class="fa fa-download" aria-hidden="true"></i>
	        </button>
        </span>

        @endif

        <h4 class="section-subtitle"></h4>

		@include('distributors.profile_report')
		@endif

    </div>
</div>

@endsection

@component('common_pages.selectize')
<script src="{{ asset('vendor/bootstrap_date-picker/js/bootstrap-datepicker.min.js') }}"></script>
<script>
//Range datepicker example
$("#token-select2").select2({
    placeholder : "Please Select Token",
    allowClear: true,
});

$("#distributor-select2").select2({
        placeholder : "Please Select distributor",
        allowClear: true,
});
</script>
@slot('css')
 <!--Date picker-->
 <link rel="stylesheet" href="{{ asset('vendor/bootstrap_date-picker/css/bootstrap-datepicker3.min.css') }}">
@endslot
@endcomponent