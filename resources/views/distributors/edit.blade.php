@extends('layouts.admin')
@section('title', 'Update Shop')
@section('content')
@php
	$shops->code = $shops->pre_code;
@endphp
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Distributor</a></li>
            <li><a>Update</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">

    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Distributor Update</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('distributors.index','<i class="fa fa-list"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">
                 {{ Form::model($shops,array('route' => array('distributors.update',$shops->id),'method' => 'PUT','enctype'=>'multipart/form-data','class'=>'form-horizontal')) }}

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group{{ $errors->has('outlet_name') ? ' has-error' : '' }}">
                                {{Form::label('outlet_name:',null,array('class' => 'control-label col-sm-3 require'))}}
                                <div class="col-md-9">
                                    {{Form::text('outlet_name',null,array('class' => 'form-control'))}}
                                    {!! $errors->first('outlet_name', '<p class="text-danger">:message</p>' ) !!}
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('proprietor_name') ? ' has-error' : '' }}">
                                {{Form::label('proprietor_name:',null,array('class' => 'control-label col-sm-3 require'))}}
                                <div class="col-md-9">
                                    {{Form::text('proprietor_name',null,array('class' => 'form-control'))}}
                                    {!! $errors->first('proprietor_name', '<p class="text-danger">:message</p>' ) !!}
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                                {{Form::label('distributor code:',null,array('class' => 'control-label col-sm-3 require'))}}
                                <div class="col-md-9">
                                    {{Form::text('code',null,array('class' => 'form-control'))}}
                                    {!! $errors->first('code', '<p class="text-danger">:message</p>' ) !!}
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                                {{Form::label('mobile:',null,array('class' => 'control-label col-sm-3 require'))}}
                                <div class="col-md-9">
                                    {{Form::number('mobile',null,array('class' => 'form-control max-length','oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength'=>11))}}
                                    {!! $errors->first('mobile', '<p class="text-danger">:message</p>' ) !!}
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('nid') ? ' has-error' : '' }}">
                                {{Form::label('NID:',null,array('class' => 'control-label col-sm-3'))}}
                                <div class="col-md-9">
                                    {{Form::number('nid',null,array('class' => 'form-control max-length','oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength'=>17))}}
                                    {!! $errors->first('nid', '<p class="text-danger">:message</p>' ) !!}
                                </div>
                            </div>
                             <div class="form-group">
                                {{Form::label('shop_category:',null,array('class' => 'control-label col-sm-3'))}}
                                <div class="col-md-9">
                                    {{Form::select('category',[''=>'Please Select Shop Category']+config('myconfig')['shop_category'],null,array('class' => 'form-control'))}}
                                </div>
                            </div>
                             <div class="form-group">
                                {{Form::label('estimated_sales:',null,array('class' => 'control-label col-sm-3'))}}
                                <div class="col-md-9">
                                    {{Form::number('estimated_sales',null,array('class' => 'form-control','step'=>'1','min'=>'0','oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength'=>9))}}
                                    {!! $errors->first('estimated_sales', '<p class="text-danger">:message</p>' ) !!}
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('trade_license') ? ' has-error' : '' }}">
                                {{Form::label('trade_license_no.:',null,array('class' => 'control-label col-sm-3'))}}
                                <div class="col-md-9">
                                    {{Form::text('trade_license',null,array('class' => 'form-control'))}}
                                    {!! $errors->first('trade_license', '<p class="text-danger">:message</p>' ) !!}
                                </div>
                            </div>

                             @foreach (config('myconfig.shop_file') as $ke=>$val)
                             	@php
                            		$label = $val;
                            		if($val == 'nid_copy'){
                            			$label = 'NID Copy';
                            		}
                            	@endphp
                                <div class="form-group">
                                    {{Form::label($label,null,array('class' => 'control-label col-sm-3'))}}
                                    <div class="col-md-7">
                                        {{Form::file($val)}}
                                        {!! $errors->first($val, '<p class="text-danger">:message</p>' ) !!}
                                    </div>
                                    <div class="col-md-2 preview-div">
                                         @if ($documents->has($val))
                                            <a href="{{ asset('storage/images/'.$shops->id.'/'.$documents[$val]) }}" target="_blank">{{ $documents[$val] }}</a>
                                          {{ Form::hidden('old_'.$val,$documents[$val])  }}
                                        @endif
                                    </div>
                                </div>
                             @endforeach
                            <hr>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                {{Form::label('shop address:',null,array('class' => 'col-sm-12'))}}
                                <div class="col-md-12">
                                    {{Form::textarea('address',null,array('class' => 'form-control max-length','maxlength'=>255))}}
                                    {!! $errors->first('address', '<p class="text-danger">:message</p>' ) !!}
                                 </div>
                             </div>
                        </div>
                    </div>

                    <!-- Start Basic Information -->
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="mb-lg"><b>Personal Information </b></h5>
                            <div class="form-group{{ $errors->has('present_address') ? ' has-error' : '' }}">
                                {{Form::label('present_address:',null,array('class' => 'control-label col-sm-4 require'))}}
                                <div class="col-md-8">
                                    {{Form::textarea('present_address',($shops->present_address??null),array('class' => 'form-control max-length','rows' => 5, 'cols' => 2,'maxlength'=>255))}}
                                    {!! $errors->first('present_address', '<p class="text-danger">:message</p>' ) !!}
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
                                {{Form::label('Date of Birth:',null,array('class' => 'control-label col-sm-4'))}}
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <span class="input-group-addon x-primary"><i class="fa fa-calendar"></i></span>
                                        {{Form::text('birthday',$shops->detail->birthday??null,array('class' => 'form-control datepicker'))}}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('marital_status') ? ' has-error' : '' }}">
                                {{Form::label('marital_status:',null,array('class' => 'control-label col-sm-4'))}}
                                <div class="col-md-8">
                                    {{Form::select('marital_status',[''=>'Please Select Marital status']+['Married'=>'Married', 'Unmarried'=>'Unmarried'],$shops->detail->marital_status??null,array('class' => 'form-control'))}}
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('spouse_name') ? ' has-error' : '' }}">
                                {{Form::label('spouse_name:',null,array('class' => 'control-label col-sm-4'))}}
                                <div class="col-md-8">
                                    {{Form::text('spouse_name',$shops->detail->spouse_name??null,array('class' => 'form-control','maxlength'=>64))}}
                                    {!! $errors->first('spouse_name', '<p class="text-danger">:message</p>' ) !!}
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('father_name') ? ' has-error' : '' }}">
                                {{Form::label('father:',null,array('class' => 'control-label col-sm-4'))}}
                                <div class="col-md-8">
                                    {{Form::text('father_name',$shops->detail->father_name??null,array('class' => 'form-control','maxlength'=>100))}}
                                    {!! $errors->first('father_name', '<p class="text-danger">:message</p>' ) !!}
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('son') ? ' has-error' : '' }}">
                                {{Form::label('No. of Son:',null,array('class' => 'control-label col-sm-4'))}}
                                <div class="col-md-8">
                                    {{Form::number('son',$shops->detail->son??null,array('class' => 'form-control','step'=>'1','min'=>'0','oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength'=>2))}}
                                    {!! $errors->first('son', '<p class="text-danger">:message</p>' ) !!}
                                </div>
                            </div>

                            <hr class="hidden-lg hidden-md">
                        </div>
                        <div class="col-md-6">
                             <h5 class="mb-lg"><b>&nbsp;</b></h5>
                                <div class="form-group{{ $errors->has('permanent_address') ? ' has-error' : '' }}">
                                    {{Form::label('permanent_address:',null,array('class' => 'control-label col-sm-4 require'))}}
                                    <div class="col-md-8">
                                        {{Form::textarea('permanent_address',$shops->parmanent_address??null,array('class' => 'form-control max-length', 'rows' => 5, 'cols' => 2,'maxlength'=>255))}}
                                        {!! $errors->first('permanent_address', '<p class="text-danger">:message</p>' ) !!}
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('business_startday') ? ' has-error' : '' }}">
                                    {{Form::label('Business Start:',null,array('class' => 'control-label col-sm-4'))}}
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <span class="input-group-addon x-primary"><i class="fa fa-calendar"></i></span>
                                            {{Form::text('business_startday',$shops->detail->business_startday??null,array('class' => 'form-control datepicker'))}}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('marriage_day') ? ' has-error' : '' }}">
                                    {{Form::label('Marriage Day:',null,array('class' => 'control-label col-sm-4'))}}
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <span class="input-group-addon x-primary"><i class="fa fa-calendar"></i></span>
                                            {{Form::text('marriage_day',$shops->detail->marriage_day??null,array('class' => 'form-control datepicker'))}}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('spouse_birthday') ? ' has-error' : '' }}">
                                    {{Form::label('Spouse Birthday:',null,array('class' => 'control-label col-sm-4'))}}
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <span class="input-group-addon x-primary"><i class="fa fa-calendar"></i></span>
                                            {{Form::text('spouse_birthday',$shops->detail->spouse_birthday??null,array('class' => 'form-control datepicker'))}}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('mother_name') ? ' has-error' : '' }}">
                                    {{Form::label('Mother:',null,array('class' => 'control-label col-sm-4'))}}
                                    <div class="col-md-8">
                                        {{Form::text('mother_name',$shops->detail->mother_name??null,array('class' => 'form-control'))}}
                                        {!! $errors->first('mother_name', '<p class="text-danger">:message</p>' ) !!}
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('daughter') ? ' has-error' : '' }}">
                                    {{Form::label('No. of Daughter:',null,array('class' => 'control-label col-sm-4'))}}
                                    <div class="col-md-8">
                                        {{Form::number('daughter',$shops->detail->daughter??null,array('class' => 'form-control','step'=>'1','min'=>'0','oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength'=>2))}}
                                        {!! $errors->first('daughter', '<p class="text-danger">:message</p>' ) !!}
                                    </div>
                                </div>
                            <hr class="hidden-lg hidden-md">
                        </div>
                    </div>

                    <hr>

                    @include('common_pages.location_zone_dropdown_edit')

                    <div class="row mb-md">
                        <div class="col-md-12">
                            <hr>
                             <h5 class="mb-lg"><b>Select Depot and Distributor </b></h5>
                            @if ($depots->isEmpty() && !empty($depotId))
                                {{ Form::hidden('depot_id',$depotId) }}
                            @else
                                <div class="form-group{{ $errors->has('depot_id') ? ' has-error' : '' }}">
                                    {{Form::label('depot:',null,array('class' => 'control-label col-sm-2 require'))}}
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
                             <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                {{Form::label('status.:',null,array('class' => 'control-label col-sm-2'))}}
                                <div class="col-md-6">
                                    {{Form::select('status',config('myconfig.status'),null,array('class' => 'form-control'))}}
                                    {!! $errors->first('status', '<p class="text-danger">:message</p>' ) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-1">
                            <button type="submit" class="btn btn-primary">
                                Distributor Update
                            </button>
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
@section('vuescript')
<script>
    laravelObj.division_id='{{ $shops->division_id or '' }}';
    laravelObj.districts =JSON.parse('{!! $districts or '' !!}');
    laravelObj.district_id='{{ $shops->district_id or '' }}';
    laravelObj.thanas =JSON.parse('{!! $thanas or '' !!}');
    laravelObj.thana_id ='{{ $shops->thana_id or '' }}';
    laravelObj.region_id='{{ $shops->region_id or '' }}';
    laravelObj.areas=JSON.parse('{!! $areas or '' !!}');
    laravelObj.area_id='{{ $shops->area_id or '' }}';
    laravelObj.isDistributor='{{ $shops->is_distributor or '0' }}';
</script>
@stop
@component('common_pages.selectize')
<script src="{{ asset('vendor/bootstrap_date-picker/js/bootstrap-datepicker.min.js') }}"></script>
    @include('common_pages.max_length')
    <script type="text/javascript">
        $('.datepicker').datepicker({ format: "yyyy-mm-dd",todayHighlight: true,autoclose:true});
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
    </script>

      @slot('css')
     <!--Date picker-->
     <link rel="stylesheet" href="{{ asset('vendor/bootstrap_date-picker/css/bootstrap-datepicker3.min.css') }}">
    @endslot
@endcomponent