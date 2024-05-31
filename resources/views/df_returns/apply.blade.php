@extends('layouts.admin')
@section('title', 'Return Apply')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Return</a></li>
            <li><a>Apply</a></li>
        </ul>
    </div>
</div>

<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Return Apply</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('returns.index','<i class="fa fa-list"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">
				{{ Form::model(request()->old(),array('route' => array('returns.apply'),'enctype'=>'multipart/form-data','class'=>'form-horizontal')) }}

					<div class="form-group{{ $errors->has('shop_id') ? ' has-error' : '' }}">
						{{Form::label('shop:',null,array('class' => 'control-label col-sm-2 require'))}}
						<div class="col-md-6">
			                <span id="shop-list">{{Form::select('shop_id',$shops,null,array('id'=>'shop_id','class' => 'form-control select2','data-placeholder'=>'Please Select Shop','onchange'=>'getCurrentDfs(this.value)'))}}</span>
			                {!! $errors->first('shop_id', '<p class="text-danger">:message</p>' ) !!}
						</div>
					</div>
                     <div id="current-df-wraper" class="form-group{{ $errors->has('current_df') ? ' has-error' : '' }}">
                        {{Form::label('return_dF:',null,array('class' => 'control-label col-sm-2 require'))}}
                        <div class="col-md-6">
                            <span id="current-df">{{Form::select('current_df',[],null,array('class' => 'form-control select2','data-placeholder'=>'Please Select DF'))}}</span>
                            {!! $errors->first('current_df', '<p class="text-danger">:message</p>' ) !!}
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('return_reason') ? ' has-error' : '' }}">
                        {{Form::label('return_reason:',null,array('class' => 'control-label col-sm-2'))}}
                        <div class="col-md-6">
                            {{Form::textarea('return_reason',null,array('class' => 'form-control max-length','maxlength'=>255,'rows'=>5))}}
                            {!! $errors->first('return_reason', '<p class="text-danger">:message</p>' ) !!}
                         </div>
                     </div>
                    <div class="form-group{{ $errors->has('withdrawal_date') ? ' has-error' : '' }}">
                        {{Form::label('withdrawal_date:',null,array('class' => 'control-label col-sm-2 require'))}}
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon x-primary"><i class="fa fa-calendar"></i></span>
                                {{Form::text('withdrawal_date',null,array('class' => 'form-control datepicker'))}}
                                {!! $errors->first('withdrawal_date', '<p class="text-danger">:message</p>' ) !!}
                            </div>
                        </div>
                    </div>
                      <div class="form-group">
                        <label for="righticon" class="col-sm-2 control-label">&nbsp;</label>
                        <div class="col-sm-5">
                            <div class="checkbox-custom checkbox-danger">
                                <input type="checkbox" id="checkboxCustom3" name="is_transfer_to_shop" value="1" v-model="cvb1">
                                <label for="checkboxCustom3" class="check">Transfer To Another Shop ?</label>
                            </div>
                        </div>
                    </div>
                    <div v-show="cvb1" class="form-group">
                        <div class="form-group{{ $errors->has('distributor_id') ? ' has-error' : '' }}">
                            {{Form::label('Distributor:',null,array('class' => 'control-label col-sm-2 require'))}}
                            <div class="col-md-6">
                                <span id="shop-list">{{Form::select('distributor_id',$distributors,null,array('id'=>'distributorId','class' => 'form-control select2','data-placeholder'=>'Please Select Distributor','onchange'=>'getDistributorShops(this.value,document.getElementById("shop_id").value)'))}}</span>
                                {!! $errors->first('distributor_id', '<p class="text-danger">:message</p>' ) !!}
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('to_shop') ? ' has-error' : '' }}">
                            {{Form::label('to_shop:',null,array('class' => 'control-label col-sm-2 require'))}}
                            <div class="col-md-6">
                                <span id="to-shop">{{Form::select('to_shop',[],null,array('id'=>'toShopId','class' => 'form-control select2','data-placeholder'=>'Please Select Shop'))}}</span>
                                {!! $errors->first('to_shop', '<p class="text-danger">:message</p>' ) !!}
                            </div>
                            {{--
                            <div class="col-md-4">
                                 {!! Html::decode(link_to_route('shops.create','<i class="fa fa-plus"></i> Add Shop',[],array('class'=>'btn btn-success btn-right-side',"onClick"=>"unselectDistributor('distributorId')",'target'=>'_blank'))) !!}
                            </div>
                            --}}
                        </div>
                    </div>

					<div class="form-group">
                        <div class="col-md-6 col-md-offset-2">
                            <button type="submit" class="btn btn-primary">
                               Apply
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
   laravelObj.cvb1='{{ old('is_transfer_to_shop') }}';
</script>
@stop
@component('common_pages.selectize')
@include('common_pages.max_length')
<script src="{{ asset('vendor/bootstrap_date-picker/js/bootstrap-datepicker.min.js') }}"></script>
<script>
    $('.datepicker').datepicker({ format: "yyyy-mm-dd",todayHighlight: true,autoclose:true});

    function unselectDistributor(id){
        $('#'+id).val('').trigger("change");
    }

    function getCurrentDfs(shopId){
          $('#current-df').html('');
            $.ajax({
              type: 'Get',
              url:"{{ route('ajax.getCurrentDfs') }}",//from requisition route (AjaxForRequisition trait)
              data:{shop_id:shopId}
            }) .done(function(response) {
             $('#current-df').html(response);
          })
          .fail(function(response) {
            console.log(response);
        });
    }
    var oldToShopId = '{{old('to_shop')}}';
    function getDistributorShops(distributorId,formShopId){
            if(!distributorId){
                distributorId=0;
            }
            if(!formShopId){
                formShopId=0;
            }
          var url='{{ route('ajax.getDistributorShops',['distributorId','formShopId']) }}';
            url=url.replaceAll({distributorId:distributorId,formShopId:formShopId});
         $('#to-shop').html('');
            $.ajax({
              type: 'Get',
              url:url,
            }).done(function(response) {
                $('#to-shop').html(response);
                if(oldToShopId){
                	$("#toShopId").val(oldToShopId).change();
            	}
            })
          .fail(function(response) {
            console.log(response);
        });
    }

    if('{{old('shop_id')}}'){
    	getCurrentDfs('{{old('shop_id')}}')
	}
    if('{{old('distributor_id')}}'){
		getDistributorShops('{{old('distributor_id')}}')
	}
</script>
  @slot('css')
  <link rel="stylesheet" href="{{ asset('vendor/bootstrap_date-picker/css/bootstrap-datepicker3.min.css') }}">
    <style>
        .checkbox-custom label.check{
            font-weight:bold;
        }
    </style>
  @endslot
@endcomponent


