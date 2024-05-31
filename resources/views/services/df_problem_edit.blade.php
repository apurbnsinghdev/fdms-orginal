@extends('layouts.admin')
@section('title', 'Update Complain Status')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Complain Status</a></li>
            <li><a>Update</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
	<div class="col-sm-12">
        <h4 class="section-subtitle"><b>Complain Status Update</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('services.problemEntryList','<i class="fa fa-list"></i>',['new'],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <div class="col-md-12">
                		<table class="table table-condensed">
                    		<tr>
                        		<th>Problem Type </th>
                        		<td>{{ $dfproblems->df_problem }}</td>
                    		</tr>
                        	<tr>
                        		<th>Token </th>
                        		<td>{{ $dfproblems->token or '' }}</td>
                        	</tr>
                            <tr>
                                <th>DF Code</th>
                                <td>{{ $dfproblems->df_code or '' }}</td>
                            </tr>
                            <tr>
                                <th>Outlet</th>
                                <td>{{ $dfproblems->outlet_name or '' }}</td>
                            </tr>
                        	{{-- <tr>
                        		<th>Daily Serial</th>
                        		<td>{{ $dfproblems->daily_serial or '' }}</td>
                        	</tr>

                        	<tr>
                        		<th>DF Size</th>
                        		<td>{{ $dfproblems->df_size or '' }}</td>
                        	</tr>
                        	<tr>
                        		<th>Region</th>
                        		<td>{{ $dfproblems->region->name or '' }}</td>
                        	</tr>
                        	<tr>
                        		<th>Depot</th>
                        		<td>{{ $dfproblems->depot->name or '' }}</td>
                        	</tr>

                        	<tr>
                        		<th>Proprietor</th>
                        		<td>{{ $dfproblems->proprietor_name or '' }}</td>
                        	</tr>
                        	<tr>
                        		<th>Mobile</th>
                        		<td>{{ $dfproblems->mobile or '' }}</td>
                        	</tr>
                        	<tr>
                        		<th>Address</th>
                        		<td>{{ $dfproblems->address or '' }}</td>
                        	</tr>
                        	<tr>
                        		<th>Received Date</th>
                        		<td>{{ $dfproblems->created_at->format('l jS \\of F Y h:i:s A') }}</td>
                        	</tr> --}}
                        	<tr>
                        		<th>Technician</th>
                        		<td>{{ $dfproblems->technician->name or '' }}</td>
                        	</tr>
                            <tr>
                                <th>Comments</th>
                                <td>{{ $dfproblems->comments }}</td>
                            </tr>
                		</table>
                    </div>
                    <div class="col-md-12">
                        <div class="tabs">
                            <!-- Tabs Header -->
                            <ul class="nav nav-tabs">
								@php
									$processingTab = $completeTab = false;
									if(old('submit') == 'processing' || old('submit') == 'support_df_gatepass'){
										$processingTab = true;
									}else{
										$completeTab = true;
									}
								@endphp
                                @if($dfproblems->pull < 1)
                                    <li @if($completeTab) class="active" @endif><a href="#in-shop" data-toggle="tab">Is resolved in shop?</a></li>
                                    <li @if($processingTab) class="active" @endif><a href="#need-pull" data-toggle="tab">Need to pull?</a></li>
                                @endif

                                @if($dfproblems->pull >= 1)
                                    <li class="active"><a href="#pulled" data-toggle="tab">Pulled DF Section</a></li>
                                     @if ($dfproblems->df_code != 'personal')
                                        <li><a href="#support" data-toggle="tab">Support DF section</a></li>
                                    @endif
                                @endif

                            </ul>
                            <!-- Tabs Content -->
                            <div class="tab-content">
                                @if($dfproblems->pull < 1)
                                    <div class="tab-pane fade @if($completeTab) in active @endif" id="in-shop">
                                        @include('services.sections.in_shop_section')
                                    </div>
                                    <div class="tab-pane fade @if($processingTab) in active @endif" id="need-pull">
                                        @include('services.sections.need_pull_section')
                                    </div>
                                @endif
                                @if($dfproblems->pull >= 1)
                                    <div class="tab-pane fade in active" id="pulled">
                                        @include('services.sections.pulled_section')
                                    </div>
                                    @if ($dfproblems->df_code != 'personal')
                                        <div class="tab-pane fade" id="support">
                                            @include('services.sections.support_df_section')
                                        </div>
                                    @endif
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('vuescript')
@php
	$isSupportDf = false;
	if(old('support') || $dfproblems->support){
		$isSupportDf = true;
	}

@endphp
<script>
    var supportDf = '{{$isSupportDf}}';
    if(supportDf){
    	laravelObj.cvb1 = 1;
    }
</script>
@stop
@component('common_pages.selectize')
	@include('common_pages.max_length')
	<script src="{{ asset('vendor/bootstrap_date-picker/js/bootstrap-datepicker.min.js') }}"></script>
    <script>
         $('.datepicker').datepicker({ format: "yyyy-mm-dd",todayHighlight: true,autoclose:true});
         //apply for damage for validation
         var isValidRemarks = "{{ $errors->has('remarks') }}";
      	var isValidDamageType = "{{ $errors->has('damage_type_id') }}";
      	if(isValidRemarks || isValidDamageType){
          	$('#common-modal').modal('show');
      	}
    </script>
    @slot('css')
     <!--Date picker-->
     <link rel="stylesheet" href="{{ asset('vendor/bootstrap_date-picker/css/bootstrap-datepicker3.min.css') }}">
    @endslot
@endcomponent