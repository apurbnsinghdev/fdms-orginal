@extends('layouts.admin')
@section('title', 'Requisition Resend')
@section('content')
@php
    $sizeDropdown=$sizes->pluck('name', 'id');
	$sizeId = old('size_id') ? : $requisitions->size_id;
	$returnDfId = old('df_return_id') ? : $requisitions->df_return_id;

	if(old('other_company_df')){
		if(old('other_company')){
			$otherCompanyDfArr = old('other_company_df');
		}else{
			$otherCompanyDfArr = [];
		}

	}else{
		$otherCompanyDfArr = json_decode($requisitions->other_company_df,true);
	}

@endphp
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Requisition</a></li>
            <li><a>Resend</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Requisition Resend</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('requisitions.index','<i class="fa fa-list"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">
			    {{ Form::model($requisitions,array('route' => array('requisitions.resend',$requisitions->id),'method' => 'PUT','enctype'=>'multipart/form-data','class'=>'form-horizontal')) }}

                     <div class="form-group">
                        {{Form::label('Requisition Type:',null,array('class' => 'control-label col-sm-2 require'))}}
                        <div class="col-md-6 pt-sm">
                            {{ Form::hidden('type',$requisitions->type) }}
                             <strong>{!! mystudy_case($requisitions->type) !!}</strong>
                        </div>
                    </div>

			    	@if ($hasExecutive)
                    <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
						{{Form::label('Sales Executive:',null,array('class' => 'control-label col-sm-2 require'))}}
						<div class="col-md-6 pt-sm">
                             <strong>{!! $requisitions->user->name or '' !!}({!! $requisitions->user->designation->short_name or '' !!})</strong>
						</div>
					</div>
                    @endif
					<div class="form-group">
						{{Form::label('shop:',null,array('class' => 'control-label col-sm-2'))}}
						<div class="col-md-6 pt-sm">
			                 <strong>{!! $requisitions->shop->outlet_name !!}</strong>
						</div>
					</div>

                    @if ($requisitions->type=='replace')
                        <div class="form-group{{ $errors->has('current_df') ? ' has-error' : '' }}">
                            {{Form::label('current_dF:',null,array('class' => 'control-label col-sm-2 require'))}}
                            <div class="col-md-6">
                                {{Form::select('current_df',[''=>'Please select current DF']+$currentdfs->toArray(),null,array('class' => 'form-control'))}}
                                {!! $errors->first('current_df', '<p class="text-danger">:message</p>' ) !!}
                            </div>
                        </div>
                    @endif

                    <div class="form-group{{ $errors->has('size_id') ? ' has-error' : '' }}">
                        {{Form::label('Df-Size:',null,array('class' => 'control-label col-sm-2 require'))}}
                        <div class="col-md-6">
                            {{Form::select('size_id',[''=>'Please Select Size']+$sizeDropdown->toArray(),null,array('onchange'=>'getRentAmount();getReturnDF(this.value)','id'=>'df-size','class' => 'form-control select2','data-placeholder'=>'Please Select size'))}}
                            {!! $errors->first('size_id', '<p class="text-danger">:message</p>' ) !!}
                            <p style="display: none;" id="stock-availability" class="text-danger">Stock is not available now.</p>
                        </div>
                    </div>
                    @if($dfreturns->isNotEmpty())
                    <div id="return-df-wrapper" class="form-group">
                    	 {{Form::label('Return_DF',null,array('class' => 'control-label col-sm-2 require'))}}
                        <div class="col-md-6">
                            <select id="df_return_id" name="df_return_id" class="form-control">
                            	<option value="">Please select DF</option>
                            	@foreach($dfreturns as $dfreturn)
                            		@if($sizeId == $dfreturn->size_id)
                            			<option value="{{$dfreturn->id}}" @if($requisitions->df_return_id == $dfreturn->id) selected @endif>{{$dfreturn->serial_no}}({{$dfreturn->outlet_name}})</option>
                            		@endif
                            	@endforeach
                            </select>
                            {!! $errors->first('df_return_id', '<p class="text-danger">:message</p>' ) !!}
                        </div>
					</div>
					@endif
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
                            <div v-show="cvb1 == 'concession'||cvb1 == 'full_paid'" class="form-group{{ $errors->has('receive_amount') ? ' has-error' : '' }}">
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
					@foreach(config('myconfig.requisition_file') as $value)
                        @if ($value=='money_receipt')
                        <div v-show="cvb4 != 'bkash' && cvb1 != 'without_rent'" class="form-group" id="{{$value}}">
                            {{Form::label($value.':',null,array('class' => 'control-label col-sm-2'))}}
                            <div class="col-md-6">
                                {{Form::file($value)}}
                                {!! $errors->first($value, '<p class="text-danger">:message</p>' ) !!}
                            </div>
                            <div class="col-md-2 preview-div">
                                 @if ($documents->has($value))
                                    <a href="{{ asset('storage/images/'.$requisitions->shop_id.'/'.$documents[$value]) }}" target="_blank">{{ $documents[$value] }}</a>
                                  {{ Form::hidden('old_'.$value,$documents[$value])  }}
                                @endif
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
                                 @if ($documents->has($value))
                                    <a href="{{ asset('storage/images/'.$requisitions->shop_id.'/'.$documents[$value]) }}" target="_blank">{{ $documents[$value] }}</a>
                                  {{ Form::hidden('old_'.$value,$documents[$value])  }}
                                @endif
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
                                {{Form::label('choose_other_company:',null,array('class' => 'control-label col-sm-6'))}}
                                <div class="col-md-8">
                                    {{Form::select('other_company_df[]',config('myconfig.other_company_df'),$otherCompanyDfArr,array('class' => 'form-control select2','multiple'=>true))}}
                                    {!! $errors->first('other_company_df', '<p class="text-danger">:message</p>' ) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                     <div class="row">
                        <div class="col-md-4 mb-md">
                            <div class="form-group">
                                {{Form::label('',null,array('class' => 'control-label col-sm-6'))}}
                                <div class="col-md-6">
                                     <div class="checkbox-custom checkbox-success">
                                         {{Form::checkbox('exclusive_outlet',1,null,array('id' => 'exclusive_outlet'))}}
                                         {{Form::label('exclusive_outlet',null,array('class' => 'check','for'=>'exclusive_outlet'))}}?
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-md">
                            <div class="form-group">
                                {{Form::label('',null,array('class' => 'control-label col-sm-6'))}}
                                <div class="col-md-6">
                                     <div class="checkbox-custom checkbox-success">
                                     	@if(!empty($requisitions->physical_visits[0]['status']))
                                         {{Form::checkbox('physically_visit',1,$requisitions->physical_visits[0]['status'],array('id' => 'physically_visit'))}}
                                         @else
                                         	{{Form::checkbox('physically_visit',1,null,array('id' => 'physically_visit'))}}
                                         @endif
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
                            <button id="btnSend" type="submit" class="btn btn-primary">
                                Resend
                            </button>
                            {{-- @endif --}}
                        </div>
                    </div>
				{{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
@section('vuescript')
@php
	if(old('payment_modes')){
		$paymentModes = old('payment_modes');
	}else{
		$paymentModes = $requisitions->payment_modes;
	}

	if(old('payment_methods')){
		$paymentMethods = old('payment_methods');
	}else{
		$paymentMethods = $requisitions->payment_methods;
	}

	if(old('other_company')){
		$otherCompany = 1;
	}else{
		$otherCompany = 0;
	}
@endphp
<script>
        var otherCompanyDf = @json($otherCompanyDfArr ?? []);

        if(Object.keys(otherCompanyDf).length > 0){
        	laravelObj.cvb2 = 1;
        }else{
            var otherCompany = {!! $otherCompany !!};
            if(otherCompany){
            	laravelObj.cvb2 = 1;
            }
        }
        laravelObj.cvb1 = '{{$paymentModes}}';
        laravelObj.cvb3=JSON.parse('{!! $sizes->pluck('rent_amount', 'id') !!}');
        laravelObj.cvb4='{{ $paymentMethods }}';
    </script>
@stop

@component('common_pages.selectize')
<script>
	//get df rent amount depends on df size
    function getRentAmount(){
        var dfSizeId = $('#df-size').val();
        var paymentMethods = $('#payment_modes').val();
        if(paymentMethods == 'full_paid' &&  dfSizeId != ''){
        	$('#receive_amount').val(laravelObj.cvb3[dfSizeId]);
        	$('#receive_amount').attr('disabled',true);
        }else if(paymentMethods == 'concession' &&  dfSizeId != ''){
        	$('#receive_amount').val(laravelObj.cvb3[dfSizeId]);
        	$('#receive_amount').attr('disabled',false);
        }else if(paymentMethods == 'without_rent' || paymentMethods == ''){
    	  	$('#payment_methods').val('');
        }
    }

    /* =========stock check start====*/
    function checkStock(size_id){
        document.getElementById("stock-availability").style.display = 'none';
        document.getElementById("btnSend").disabled = false;
        var sizeId = size_id;
        var depotId = '{{$requisitions->depot_id}}';
        if(sizeId){
            $.ajax({
                  type: 'Get',
                  url:"{{ route('ajax.checkStock') }}",
                  data:{depot_id:depotId,size_id:sizeId}
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

  //get return df
    function getReturnDF(sizeId){
        var shopId = '{{$requisitions->shop_id}}';
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
               checkStock(sizeId);
             }
        }).fail(function(response) {
            console.log(response);
        });
    }
    @if($dfreturns->isEmpty())
        @if(old('size_id'))
            checkStock('{{old('size_id')}}');
        @else
            checkStock('{{$requisitions->size_id}}');
        @endif
    @endif
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