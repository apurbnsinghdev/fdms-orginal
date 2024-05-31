@extends('layouts.admin')
@section('title', 'Payment Verify')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Requisition</a></li>
            <li><a>Payment Verify</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Payment Verify</b></h4>
        <span class="pull-right">
        	{!! Html::decode(link_to_route('requisitions.index','<i class="fa fa-list"></i>',['approved'],array('class'=>'btn btn-success btn-right-side'))) !!}
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
						<div class="left-element">Receive Amount:</div>
						 <div class="text">{{mystudy_case($requisition->receive_amount)}}</div>
					</li>
					@if($requisition->payment_verrified_by)
					<li>
						<div class="left-element">Payment Varified By:</div>
						 <div class="text">{{$requisition->payment_verifier->name}}</div>
					</li>
					@endif
					@if ($requisition->documents->isNotEmpty())
					<li>
						<div class="left-element">Money Receipt:</div>
						 <div class="text"><a href="{{ asset('storage/images/'.$requisition->shop_id.'/'.$requisition->documents[0]->file_name) }}" target="_blank">{{ $requisition->documents[0]->file_name }}</a></div>
					</li>
					@endif
				</ul>
			</div>
			<br>
        	@if(!$requisition->payment_verified)
				{{ Form::model(request()->old(),array('route' => array('requisitions.payment_verify',request()->route()->parameters['param']),'method'=>'put','enctype'=>'multipart/form-data','class'=>'confirm-form form-horizontal')) }}
					 
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
        		@elseif($requisition->payment_verified == 'no')
				{{ Form::model(request()->old(),array('route' => array('requisitions.payment_verify',request()->route()->parameters['param']),'method'=>'put','enctype'=>'multipart/form-data','class'=>'confirm-form form-horizontal')) }}
					<div class="form-group">
                        <div class="col-md-6 col-md-offset-2">
                            <button type="submit" name="verified" value="verified" class="btn btn-primary">
                                Verified
                            </button>
                        </div>
                    </div>
				{{ Form::close() }}
        @endif
        </div>
		</div>
	</div>
</div>
@endsection
@section('css')
<style>
    .left-element{min-width: 160px !important;font-weight: bold;text-align: right;padding-right: 10px}
</style>
@stop

