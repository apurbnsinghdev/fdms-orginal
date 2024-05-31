@extends('layouts.admin')
@section('title', 'Add Requisition')
@section('content')
@php
    $sizeDropdown=$sizes->pluck('name', 'id');
    $selectedShopId='';
    $disabled=false;
    $requisition_file = config('myconfig.requisition_file');
   unset($requisition_file[array_search('deed_paper',$requisition_file)]);
@endphp

@if (request()->route()->parameters)
    @php
         $selectedShopId=request()->route()->parameters['param'];
         $disabled=true;
    @endphp
@endif

<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Requisition</a></li>
            <li><a>Add</a></li>
        </ul>
    </div>
</div>

<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Requisition Add</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('requisitions.index','<i class="fa fa-list"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">
				{{ Form::model(request()->old(),array('route' => array('requisitions.store'),'enctype'=>'multipart/form-data','class'=>'form-horizontal')) }}
                    <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                        {{Form::label('Requisition Type',null,array('class' => 'control-label col-sm-2 require'))}}
                        <div class="col-md-6">
                            {{Form::select('type',['new_inject'=>'New Inject','replace'=>'Replace'],null,array('class' => 'form-control','onchange'=>'showItemList(this.value)'))}}
                             {!! $errors->first('type', '<p class="text-danger">:message</p>' ) !!}
                        </div>
                    </div>
                    <div id="comment-wraper" class="hidden form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                        {{Form::label('Replace Reason:',null,array('class' => 'control-label col-sm-2 require'))}}
                        <div class="col-md-6">
                            {{Form::textarea('comment',null,array('class' => 'form-control max-length','maxlength'=>150,'rows'=>4))}}
                            {!! $errors->first('comment', '<p class="text-danger">:message</p>' ) !!}
                        </div>
                    </div>
					@if ($hasExecutive)
                    <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
						{{Form::label('Sales Executive:',null,array('class' => 'control-label col-sm-2 require'))}}
						<div class="col-md-6">
			                {{Form::select('user_id',[''=>'Please Select ..']+$salesExecutives,null,array('class' => 'form-control select2','onchange'=>'getExecutiveDepotShop(this.value)','data-placeholder'=>'Please Select..'))}}
			                {!! $errors->first('user_id', '<p class="text-danger">:message</p>' ) !!}
						</div>
					</div>
                    @endif
					<div class="form-group{{ $errors->has('shop_id') ? ' has-error' : '' }}">
						{{Form::label('shop:',null,array('class' => 'control-label col-sm-2 require'))}}
						<div class="col-md-6">
			                <span id="shop-list">{{Form::select('shop_id',[''=>'Please Select Shop']+$shops->toArray(),$selectedShopId,array('disabled'=>$disabled,'id'=>'shop_id','class' => 'form-control select2','data-placeholder'=>'Please Select Shop','onchange'=>'getCurrentDfs(this.value);getReturnDFSizes(this.value);'))}}</span>
			                {!! $errors->first('shop_id', '<p class="text-danger">:message</p>' ) !!}
						</div>
                        @if ($disabled)
                            <input type="hidden" name="shop_id" value="{{ $selectedShopId }}">
                        @else
                            <div class="col-md-4">
                                 {!! Html::decode(link_to_route('shops.create','<i class="fa fa-plus"></i> Add Shop',[],array('class'=>'btn btn-success btn-right-side'))) !!}
                            </div>
                        @endif
					</div>

                    <div id="current-df-wraper" class="hidden form-group{{ $errors->has('current_df') ? ' has-error' : '' }}">
                        {{Form::label('current_dF:',null,array('class' => 'control-label col-sm-2 require'))}}
                        <div class="col-md-6">
                            <span id="current-df"></span>
                            {!! $errors->first('current_df', '<p class="text-danger">:message</p>' ) !!}
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('size_id') ? ' has-error' : '' }}">
                        {{Form::label('Df-Size:',null,array('class' => 'control-label col-sm-2 require'))}}
                        <div class="col-md-6">
                           <span id="size-container">
                            {{Form::select('size_id',[''=>'Please Select Size']+$sizeDropdown->toArray(),null,array('onchange'=>'getRentAmount();getReturnDF(this.value);','id'=>'df-size','class' => 'form-control'))}}
                            </span>
                            {!! $errors->first('size_id', '<p class="text-danger">:message</p>' ) !!}
                            <p style="display: none;" id="stock-availability" class="text-danger">Stock is not available but you can save it as a draft</p>
                        </div>
                    </div>
					<div id="return-df-wrapper" class="form-group"></div>
                    <div class="row mb-md">
                        <div class="col-md-4">
                            <div class="form-group{{ $errors->has('payment_modes') ? ' has-error' : '' }}">
                                {{Form::label('payment_modes:',null,array('class' => 'control-label col-sm-6 require'))}}
                                <div class="col-md-6">
                                    {{Form::select('payment_modes',[''=>'Please Select']+config('myconfig.payment_modes'),null,array('v-model'=>'cvb1','onchange'=>'getRentAmount()','id'=>'payment_modes','class' => 'form-control'))}}
                                    {!! $errors->first('payment_modes', '<p class="text-danger">:message</p>' ) !!}
                                </div>
                            </div>
                        </div>
                         <div class="col-md-4">
                            <div v-show="cvb1 == 'concession'||cvb1 == 'full_paid'" class="form-group {{ $errors->has('receive_amount') ? ' has-error' : '' }}">
                                {{Form::label('receive_amount:',null,array('class' => 'control-label col-sm-6'))}}
                                <div class="col-md-6">
                                    {{Form::number('receive_amount',null,array(':readonly'=>"cvb1 == 'full_paid'",'id'=>'receive_amount','class' => 'form-control','min'=>0,'oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength'=>5))}}
                                    {!! $errors->first('receive_amount', '<p class="text-danger">:message</p>' ) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div v-show="cvb1 == 'concession'||cvb1 == 'full_paid'" class="{{ $errors->has('receive_amount') ? ' has-error' : '' }}">
                                {{Form::label('payment_methods:',null,array('class' => 'control-label col-sm-6'))}}
                                <div class="col-md-6">
                                    {{Form::select('payment_methods',[''=>'Please Select']+config('myconfig.payment_methods'),null,array('v-model'=>'cvb4','id'=>'payment_methods','class' => 'form-control'))}}
                                    {!! $errors->first('payment_methods', '<p class="text-danger">:message</p>' ) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- requisition's file upload--}}
					@foreach($requisition_file as $value)
                        @if ($value=='money_receipt')
                            <div v-show="cvb4 != 'bkash' && cvb1 != 'without_rent'" class="form-group" id="{{$value}}">
                                {{Form::label($value.':',null,array('class' => 'control-label col-sm-2'))}}
                                <div class="col-md-6">
                                    {{Form::file($value)}}
                                    {!! $errors->first($value, '<p class="text-danger">:message</p>' ) !!}
                                </div>
                                <div class="col-md-2 preview-div">
                                </div>
                            </div>
                        @else
                            <div class="form-group" id="{{$value}}">
                               {{Form::label($value.':',null,array('class' => 'control-label col-sm-2'))}}
                                <div class="col-md-6">
                                    {{Form::file($value)}}
                                    {!! $errors->first($value, '<p class="text-danger">:message</p>' ) !!}
                                </div>
                                <div class="col-md-2 preview-div">
                                </div>
                            </div>
                        @endif
					@endforeach

                     <div class="row mb-md">
                        <div class="col-md-4">
                            <div class="form-group{{ $errors->has('payment_modes') ? ' has-error' : '' }}">
                                {{Form::label('',null,array('class' => 'control-label col-sm-6'))}}
                                <div class="col-md-6">
                                     <div class="checkbox-custom checkbox-success">
                                         {{Form::checkbox('other_company',1,null,array('v-model'=>'cvb2','id' => 'other_company'))}}
                                         {{Form::label('other_company',null,array('class' => 'check','for'=>'other_company'))}}?
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div v-show="cvb2" class="form-group{{ $errors->has('other_company_df') ? ' has-error' : '' }}">
                                {{Form::label('choose_other_company:',null,array('class' => 'control-label col-sm-4'))}}
                                <div class="col-md-8">
                                    {{Form::select('other_company_df[]',config('myconfig.other_company_df'),null,array('class' => 'form-control select2','multiple'=>true))}}
                                    {!! $errors->first('other_company_df', '<p class="text-danger">:message</p>' ) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-md-4 mb-md">
                            <div class="form-group{{ $errors->has('payment_modes') ? ' has-error' : '' }}">
                                {{Form::label('',null,array('class' => 'control-label col-sm-6'))}}
                                <div class="col-md-6">
                                     <div class="checkbox-custom checkbox-success">
                                         {{Form::checkbox('exclusive_outlet',1,null,array('id' => 'exclusive_outlet','checked'))}}
                                         {{Form::label('exclusive_outlet',null,array('class' => 'check','for'=>'exclusive_outlet'))}}?
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-md">
                            <div class="form-group{{ $errors->has('payment_modes') ? ' has-error' : '' }}">
                                {{Form::label('',null,array('class' => 'control-label col-sm-6'))}}
                                <div class="col-md-6">
                                     <div class="checkbox-custom checkbox-success">
                                     	 {{Form::checkbox('physically_visit',1,null,array('id' => 'physically_visit','checked'))}}
                                         {{Form::label('physically_visit',null,array('class' => 'check','for'=>'physically_visit'))}}?
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group{{ $errors->has('distance_from_dist') ? ' has-error' : '' }}">
                                {{Form::label('distance_from_dist.(Km.):',null,array('class' => 'control-label col-sm-6 require'))}}
                                <div class="col-md-6">
                                    {{Form::number('distance_from_dist',null,array('class' => 'form-control','min'=>0,'max'=>'50','step'=>'any'))}}
                                    {!! $errors->first('distance_from_dist', '<p class="text-danger">:message</p>' ) !!}
                                </div>
                            </div>
                        </div>
                         <div class="col-md-4 mb-md">
                            <div class="form-group{{ $errors->has('visibility_of_df') ? ' has-error' : '' }}">
                                {{Form::label('Visibility_of_dF:',null,array('class' => 'control-label col-sm-6'))}}
                                <div class="col-md-6">
                                    {{Form::text('visibility_of_df',null,array('class' => 'form-control','placeholder'=>'Ex:Front Side'))}}
                                    {!! $errors->first('visibility_of_df', '<p class="text-danger">:message</p>' ) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group{{ $errors->has('last_three_months_avg_sales') ? ' has-error' : '' }}">
                                {{Form::label('last_three_months_avg_dF_sales:',null,array('class' => 'control-label col-sm-6'))}}
                                <div class="col-md-6">
                                    {{Form::number('last_three_months_avg_sales',null,array('class' => 'form-control','min'=>0))}}
                                    {!! $errors->first('last_three_months_avg_sales', '<p class="text-danger">:message</p>' ) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-md">
                            <div class="form-group{{ $errors->has('average_sales') ? ' has-error' : '' }}">
                                {{Form::label('yearly_average_dF_sales:',null,array('class' => 'control-label col-sm-6'))}}
                                <div class="col-md-6">
                                    {{Form::number('average_sales',null,array('class' => 'form-control'))}}
                                    {!! $errors->first('average_sales', '<p class="text-danger">:message</p>' ) !!}
                                </div>
                            </div>
                        </div>
                    </div>

					<div class="form-group">
                        <div class="col-md-6 col-md-offset-2">
                            <button type="submit" name="draft" class="btn btn-primary">
                                Save As Draft
                            </button>
                            {{-- @if (!$hasExecutive) --}}
                             <button type="submit" name="send" id="btnSend" class="btn btn-primary">
                                Send
                             </button>
                          {{--   @endif --}}
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
    laravelObj.cvb1='{{ old('payment_modes') }}';
    laravelObj.cvb2='{{ old('other_company') }}';
    laravelObj.cvb3=JSON.parse('{!! $sizes->pluck('rent_amount', 'id') !!}');
    laravelObj.cvb4='{{ old('payment_methods') }}';

</script>
@stop
@component('common_pages.selectize')
    @include('common_pages.max_length')
<script>
    var shopId='{{ $selectedShopId }}';
    var oldShopId='{{old('shop_id')}}';
    var oldSizeId='{{old('size_id')}}';
    var hasExecutive='{{ $hasExecutive }}';

        function getRentAmount(){
            var dfSizeId = $('#df-size').val();
            var paymentMethods = $('#payment_modes').val();
            if(paymentMethods == 'full_paid' &&  dfSizeId != ''){
            	$('#receive_amount').val(laravelObj.cvb3[dfSizeId]);
            }else if(paymentMethods == 'concession' &&  dfSizeId != ''){
            	$('#receive_amount').val(laravelObj.cvb3[dfSizeId]);
            }else if(paymentMethods == 'without_rent' || paymentMethods == ''){
        	  	$('#payment_methods').val('');
            }
        }

		//get shops or distributor
        function getExecutiveDepotShop(userId){
            //stock validation message false
        	document.getElementById("stock-availability").style.display = 'none';
        	$('#shop-list').html('');
        	$.ajax({
              type: 'Get',
              url:"{{ route('ajax.getShops') }}",
              data:{user_id:userId}
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
            if(oldShopId){
            	$("#shop_id").val(oldShopId).change();
            }

          })
          .fail(function(response) {
            console.log(response);
          });
        }

		if('{{old('user_id')}}'){
			getExecutiveDepotShop('{{old('user_id')}}');
		}

        var call=false;
        function showItemList(val){
            if(val=='replace'){
                call=true;
                $('#current-df').html('<select name="current_df" class="form-control"><option value="" selected="selected">Please select current DF</option></select>');
                $('#current-df-wraper').removeClass('hidden');
                $('#comment-wraper').removeClass('hidden');
                if (shopId){
                    getCurrentDfs(shopId);
                }
            }else{
                call=false;
               $('#current-df-wraper').addClass('hidden');
               $('#comment-wraper').addClass('hidden');
            }
        }

        if('{{old('type')}}'){
            showItemList('{{old('type')}}');
        }

        function getCurrentDfs(shopId){
            if(call){
                  $('#current-df').html('');
                    $.ajax({
                      type: 'Get',
                      url:"{{ route('ajax.getCurrentDfs') }}",
                      data:{shop_id:shopId}
                    }) .done(function(response) {
                     $('#current-df').html(response);
                  })
                  .fail(function(response) {
                    console.log(response);
                });
            }
        }

        function getSizeDropdown(Obj){
            var inverted=_.invert(Obj);
            var ObjectsObj=Object.keys(inverted);
            var sizes=`<select onchange="getRentAmount();getReturnDF(this.value);" id="df-size" name="size_id" class="form-control">
                        <option value="" selected="selected">Please Select Size</option>`;
                        if (ObjectsObj.length==1){
                             sizes+=`<option selected value="`+Object.values(inverted)[0]+`">`+ObjectsObj[0]+`</option>`;
                        }else{
                            ObjectsObj.forEach(function(key) {
                               sizes+=`<option value="`+inverted[key]+`">`+key+`</option>`;
                            });
                        }
                sizes+=`</select>`;
            return sizes;
        }

        //dropdown list for return df
        function getReturnDfDropdown(Obj){
            var dfsHtml=`<select name="df_return_id" class="form-control">
                        <option value="" selected="selected">Please Select DF</option>`;
                        Obj.forEach(function(vl) {
                        	dfsHtml+=`<option value="`+vl.id+`">`+vl.serial_no+ `(`+vl.outlet_name+`)</option>`;
                        });
                        dfsHtml+=`</select>`;
                var divMain = '<div class="{{ $errors->has('df_return_id') ? ' has-error' : '' }}">'+
					'<label for="df_return_id:" class="control-label col-sm-2 require">Return DF</label>'+
					'<div class="col-md-6">'+
					dfsHtml+
					'{!! $errors->first('df_return_id', '<p class="text-danger">:message</p>' ) !!}'+
					'</div>'+
				'</div>';
            return divMain;
        }

        /* =========stock check start====*/
        function checkStock(shopId,sizeId){
            document.getElementById("stock-availability").style.display = 'none';
            document.getElementById("btnSend").disabled = false;
            //var sizeId = $('#df-size').val();
            //var shopId = $('#shop_id').val();
            if(shopId && sizeId){
                $.ajax({
                      type: 'Get',
                      url:"{{ route('ajax.checkStock') }}",
                      data:{shop_id:shopId,size_id:sizeId}
                  }).done(function(response) {
                      if(response < 1){
                          document.getElementById("stock-availability").style.display = 'block';
                          document.getElementById("btnSend").disabled = true;
                      }
                  }).fail(function(response) {
                      console.log(response);
                  });
            }
        }
        /* =========stock check start====*/

        //get return df
        function getReturnDF(sizeId){
            var shopId = $('#shop_id').val();
            $('#return-df-wrapper').html('');
            $.ajax({
                type: 'Get',
                url:"{{ route('ajax.getReturnDF') }}",
                data:{shop_id:shopId,size_id:sizeId}
            }).done(function(response) {
                if(response.datas.length){
                    var tabledata=getReturnDfDropdown(response.datas);
                     $('#return-df-wrapper').html(tabledata);
                 }else{
                     checkStock(shopId,sizeId);
                 }
            }).fail(function(response) {
                console.log(response);
            });
        }

        //get sizes
        function getReturnDFSizes(shopId){
            //stock validation message false
        	document.getElementById("stock-availability").style.display = 'none';
            $('#return-df-wrapper').html('');
            $.ajax({
                type: 'Get',
                url:"{{ route('ajax.getReturnDFSizes') }}",
                data:{shop_id:shopId}
            }).done(function(response) {
            	var sizesData=getSizeDropdown(response);
                $('#size-container').html(sizesData);
                if(oldSizeId){
                	$("#df-size").val(oldSizeId).change();
                }
                var sizeId = $('#df-size').val();
                if(sizeId){
                    getReturnDF(sizeId);
                }
            }).fail(function(response) {
                console.log(response);
            });
        }


        if(!hasExecutive && oldShopId){
             getCurrentDfs(oldShopId);
        }else if(shopId){
             getCurrentDfs(shopId);
             getReturnDFSizes(shopId);
        }
        if(oldShopId){
        	getReturnDFSizes(oldShopId);
       }

    </script>
  @slot('css')
    <style>
        .checkbox-custom label.check{
            font-weight:bold;
        }
        #return-df-wrapper:empty{
            margin-bottom:0;
        }
    </style>
  @endslot
@endcomponent