@extends('layouts.admin')
@section('title', 'Bkash Payment Verify')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Requisition</a></li>
            <li><a>Bkash Payment Verify</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Bkash Payment Verify</b></h4>
        <span class="pull-right">
        	@if(url()->previous() == url()->current())
            	{!! Html::decode(link_to_route('requisitions.index','<i class="fa fa-list"></i>',['new'],array('class'=>'btn btn-success btn-right-side'))) !!}
            @else
            	{!! Html::decode(link_to(url()->previous(),'<i class="fa fa-list"></i>',array('class'=>'btn btn-success btn-right-side'))) !!}
            @endif
        </span>
        <div class="panel">
            <div class="panel-content">
            	<div class="widget-list list-left-element list-sm">
            		<ul class="dashboard">
                    	<li>
                    		<div class="left-element">Depot:</div>
                    		<div class="text">{{$requisition->depot->name}}</div>
                    	</li>
                    	<li>
                    		<div class="left-element">Shop:</div>
                    		<div class="text">{{$requisition->shop->outlet_name}}</div>
                    	</li>
                    	<li>
                    		<div class="left-element">DF Size:</div>
                    		<div class="text">DF-{{$requisition->size->name}}</div>
                    	</li>
                    	<li>
                    		<div class="left-element">Payment Modes:</div>
                    		<div class="text">{{mystudy_case($requisition->payment_modes)}}</div>
                    	</li>
                    	<li>
                    		<div class="left-element">Payment Methods:</div>
                    		<div class="text">
                                @if ($requisition->payment_methods)
                                   {{config('myconfig.payment_methods')[$requisition->payment_methods]}}
                                @endif
                            </div>
                    	</li>
                    	<li>
                    		<div class="left-element">Payable Amount:</div>
                    		<div class="text">{{mystudy_case($requisition->receive_amount)}}</div>
                    	</li>
                    	@if($requisition->payment_verrified_by)
                        	<li>
                        		<div class="left-element">Payment Varified By:</div>
                        		<div class="text">{{$requisition->payment_verifier->name}}</div>
                        	</li>
                		@endif
                		<li>
							<div class="row">
								<div class="col-md-2 left-element">Paid Amount Info:</div>
                				<div class="col-md-6">
                    				<table class="table">
                    					<tbody>
                        					<tr>
                        						<th>Transaction ID</th>
                        						<th>Transaction Time</th>
                        						<th>Amount (BDT)</th>
                        					</tr>
                    					</tbody>
                        				<tbody>
                        					@php $total = 0;@endphp
                        					@foreach($requisition->bkashes as $bkash)
                        						@php
                        							$total = $total + $bkash->receive_amount;
                        						@endphp
                        					<tr>
                        						<td>{{$bkash->transaction_id}}</td>
                        						<td>{{$bkash->trx_time}}</td>
                        						<td>{{$bkash->receive_amount}}</td>
                        					</tr>
                        					@endforeach
                        					<tr>
                        						<td>&nbsp;</td>
                        						<td class="text-right"><strong>Total=</strong></td>
                        						<td>{{$total}}</td>
                        					</tr>
                        				</tbody>
                    				</table>
                				</div>
                			</div>
                		</li>
                	</ul>
        		</div>
            </div>
        	@if(!$requisition->payment_verified)
            <div class="panel-content">
				{{ Form::model(request()->old(),array('route' => array('requisitions.bkash_verify',request()->route()->parameters['param']),'method'=>'put','class'=>'confirm-form form-horizontal')) }}
					<div class="form-group">
                        <div class="col-md-6 col-md-offset-2">
                            <button type="submit" name="verified" value="verified" class="btn btn-primary">
                                Verified
                            </button>
                             <button type="submit" name="notVerified" value="notVerified" class="btn btn-primary">
                                Not Verified
                            </button>
                        </div>
                    </div>
				{{ Form::close() }}
            </div>
        	@elseif($requisition->payment_verified == 'no')
            <div class="panel-content">
				{{ Form::model(request()->old(),array('route' => array('requisitions.bkash_verify',request()->route()->parameters['param']),'method'=>'put','class'=>'confirm-form form-horizontal')) }}

					<div class="form-group">
                        <div class="col-md-6 col-md-offset-2">
                            <button type="submit" name="verified" value="verified" class="btn btn-primary">
                                Verified
                            </button>
                        </div>
                    </div>
				{{ Form::close() }}
            </div>
        @endif
		</div>
	</div>
</div>
@endsection
@section('css')
<style>
    .left-element{min-width: 160px !important;font-weight: bold;text-align: right;padding-right: 10px}
</style>
@stop

