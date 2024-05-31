@extends('layouts.admin')
@section('title', 'Freeze Assign')
@section('content')


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
        <h4 class="section-subtitle"><b>Freeze Assign</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('requisitions.index','<i class="fa fa-list"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
        <table class="table table-condensed">
        	<tr>
        		<th>Depot</th>
        		<td>{{$requisition->depot->name}}</td>
        	</tr>
        	<tr>
        		<th>DF Size</th>
        		<td>DF-{{$requisition->size->name}}</td>
        	</tr>
        	<tr>
        		<th>Payment Modes</th>
        		<td>{{mystudy_case($requisition->payment_modes)}}</td>
        	</tr>
        	@if($requisition->payment_modes != 'without_rent')
        	<tr>
        		<th>Payment Methods</th>
        		<td>
                    @if ($requisition->payment_methods)
                       {{config('myconfig.payment_methods')[$requisition->payment_methods]}}
                    @endif
                </td>
        	</tr>
        	<tr>
        		<th>Receive Amount</th>
        		<td>{{mystudy_case($requisition->receive_amount)}}</td>
        	</tr>
        	@endif
        	@if($requisition->payment_verrified_by)
        	<tr>
        		<th>Payment Varified By</th>
        		<td>{{$requisition->payment_verifier->name}}</td>
        	</tr>
        	@endif
		</table>
            <div class="panel-content">
				{{ Form::model(request()->old(),array('route' => array('requisitions.freeze_assign',request()->route()->parameters['param']),'method'=>'post','class'=>'form-horizontal freezeAssignFrm')) }}
					 @if($items->count())
                    <div class="form-group{{ $errors->has('item_id') ? ' has-error' : '' }}">
                        {{Form::label('DF:',null,array('class' => 'control-label col-sm-2 require'))}}
                        <div class="col-md-6">
                            {{Form::select('item_id',[''=>'Please Select..'] +  $items->toArray(),null,array('id'=>'df-size','class' => 'form-control select2','data-placeholder'=>'Please Select..'))}}
                            {!! $errors->first('item_id', '<p class="text-danger">:message</p>' ) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-2">
                             <button type="submit" class="btn btn-primary">
                                Send
                            </button>
                        </div>
                	</div>
                    @else
                    	@if($noOfItemWithoutSerial)
                        	@php
                        		$preSerial = 'DIIL/';
                        		if($itemFirst->brand){
                        			$preSerial = $preSerial . $itemFirst->brand->short_code . '/';
                        		}else{
                        			$preSerial = $preSerial . '--/';
                        		}
                        		$preSerial = $preSerial . $requisition->size->name . '/';
                        	@endphp
                    	<table class="table">
                    		<tr>
                        		<td class="text-right">{{Form::label('Serial No:',null,array('class' => 'control-label require'))}}</td>
                        		<td class="form-group{{ $errors->has('serial_no') ? ' has-error' : '' }}{{ $errors->has('serial') ? ' has-error' : '' }}">
                            		<div class="input-group">
            							<span class="input-group-addon" id="pre-serial">{{$preSerial}}</span>
            							{{Form::hidden('id',$itemFirst->id)}}
            							{{Form::hidden('pre_serial',$preSerial)}}
                                        @if (old('serial'))
                                            {{Form::text('serial_no',str_replace($preSerial,"",old('serial')),array('required','class' => 'form-control max-length','oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength'=>7))}}
                                        @else
                                             {{Form::text('serial_no',null,array('required','class' => 'form-control max-length','oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength'=>7))}}
                                        @endif
            						</div>
            						{!! $errors->first('serial_no', '<p class="text-danger">:message</p>' ) !!}
                                    {!! $errors->first('serial', '<p class="text-danger">:message</p>' ) !!}
                        		</td>
                        		<td class="pt-md">You have {{$noOfItemWithoutSerial}} without serial item(s)</td>
                    		</tr>
                    	</table>
    					<div class="form-group">
                            <div class="col-md-6 col-md-offset-2">
                                 <button type="submit" class="btn btn-primary">
                                    Send
                                </button>
                            </div>
                    	</div>
                    	@else
                    		You have no Item
                    	@endif
                     @endif


				{{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
@component('common_pages.selectize') @endcomponent
@section('script')
	@include('common_pages.max_length')
	<script type="text/javascript">
        $(document).on('submit', '.freezeAssignFrm', function() {
            return confirm('Assigned serial can\'t be changed further.Are you sure to proceed ?');
        });
	</script>
@stop

