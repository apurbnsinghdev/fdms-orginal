@extends('layouts.admin')
@section('title', 'Add Shop')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Shop</a></li>
            <li><a>Add</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">

    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Shop Add</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('shops.index','<i class="fa fa-list"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">
				{{ Form::model(request()->old(),array('route' => array('shops.store'),'enctype'=>'multipart/form-data','class'=>'form-horizontal')) }}

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
                                    </div>
                                </div>
                            @endforeach
                            <hr>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                {{Form::label('Shop Address:',null,array('class' => 'col-sm-12 require'))}}
                                <div class="col-md-12">
                                    {{Form::textarea('address',null,array('class' => 'form-control max-length','maxlength'=>255))}}
                                    {!! $errors->first('address', '<p class="text-danger">:message</p>' ) !!}
                                 </div>
                             </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('present_address') ? ' has-error' : '' }}">
                                {{Form::label('present_address:',null,array('class' => 'control-label col-sm-4 require'))}}
                                <div class="col-md-8">
                                    {{Form::textarea('present_address',null,array('class' => 'form-control max-length','rows' => 5, 'cols' => 2,'maxlength'=>255))}}
                                    {!! $errors->first('present_address', '<p class="text-danger">:message</p>' ) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('parmanent_address') ? ' has-error' : '' }}">
                                    {{Form::label('permanent_address:',null,array('class' => 'control-label col-sm-4 require'))}}
                                    <div class="col-md-8">
                                        {{Form::textarea('parmanent_address',null,array('class' => 'form-control max-length', 'rows' => 5, 'cols' => 2,'maxlength'=>255))}}
                                        {!! $errors->first('parmanent_address', '<p class="text-danger">:message</p>' ) !!}
                                    </div>
                                </div>
                        </div>
                    </div>

                    @include('common_pages.location_zone_dropdown_add')

                    <div class="row mb-md">
                        <div class="col-md-12">
                            <hr>
                             <h5 class="mb-lg"><b>Select Distributor </b></h5>
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
                        </div>
                    </div>

					<div class="form-group">
                        <div class="col-md-6 col-md-offset-1">
                            <button type="submit" class="btn btn-primary">
                                Shop Add
                            </button>
                             <button type="submit" name="requisition" class="btn btn-primary">
                                Shop add and go for requisition
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
    laravelObj.division_id='{{ old('division_id') }}';
    laravelObj.district_id='{{ old('district_id') }}';
    laravelObj.thana_id='{{ old('thana_id') }}';
    laravelObj.region_id='{{ old('region_id') }}';
    laravelObj.area_id='{{ old('area_id') }}';
</script>
@stop
@component('common_pages.selectize')
    @include('common_pages.max_length')
    <script type="text/javascript">
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
@endcomponent
