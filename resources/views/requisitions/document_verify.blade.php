@extends('layouts.admin')
@section('title', 'Document Verify')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Requisition</a></li>
            <li><a>Document Verify</a></li>
        </ul>
    </div>
</div> 
@php 
	
	if($requisition->status == 'completed'){
		$requisitionFileArr = ['deed_paper'];
		$shoFileArr = [];
	}else{
    	$requisitionFileArr = config('myconfig.requisition_file');
    	$shoFileArr = config('myconfig.shop_file');
		unset($requisitionFileArr[array_search('deed_paper',$requisitionFileArr)]);
	}
	
	
	 
	 
@endphp
<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Document Verify</b></h4>
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
    				</ul>
    			</div>
            	
				{{ Form::model($requisition,array('route' => array('requisitions.document_verify',request()->route()->parameters['param']),'method'=>'PUT','enctype'=>'multipart/form-data','class'=>'form-horizontal confirm-form')) }}
					{{-- shop's file upload--}}
					@foreach($shoFileArr as $value)
				  	<div class="form-group">
                        {{Form::label($value.':',null,array('class' => 'control-label col-sm-2'))}}
                        <div class="col-md-6">
                            {{Form::file($value)}}
                            {!! $errors->first($value, '<p class="text-danger">:message</p>' ) !!}
                        </div>
                        <div class="col-md-2 preview-div">
                             @if ($documents->has($value))
                                <a href="{{ asset('storage/images/'.$requisition->shop_id.'/'.$documents[$value]) }}" target="_blank">{{ $documents[$value] }}</a>
                              {{ Form::hidden('old_'.$value,$documents[$value])  }}
                            @endif
                        </div>
                    </div>
					@endforeach
					{{-- requisition's file upload--}}
					@foreach($requisitionFileArr as $value)
    					@if($value == 'money_receipt')
        					@if($requisition->payment_verified !='yes' && $requisition->payment_methods !='bkash' )
        					<div class="form-group">
                                {{Form::label($value.':',null,array('class' => 'control-label col-sm-2'))}}
                                <div class="col-md-6">
                                    {{Form::file($value)}}
                                    {!! $errors->first($value, '<p class="text-danger">:message</p>' ) !!}
                                </div>
                                <div class="col-md-2 preview-div">
                                     @if ($documents->has($value))
                                        <a href="{{ asset('storage/images/'.$requisition->shop_id.'/'.$documents[$value]) }}" target="_blank">{{ $documents[$value] }}</a>
                                      {{ Form::hidden('old_'.$value,$documents[$value])  }}
                                    @endif
                                </div>
                            </div>
                            @endif
    					@else
    					<div class="form-group">
                            {{Form::label($value.':',null,array('class' => 'control-label col-sm-2'))}}
                            <div class="col-md-6">
                                {{Form::file($value)}}
                                {!! $errors->first($value, '<p class="text-danger">:message</p>' ) !!}
                            </div>
                            <div class="col-md-2 preview-div">
                                 @if ($documents->has($value))
                                    <a href="{{ asset('storage/images/'.$requisition->shop_id.'/'.$documents[$value]) }}" target="_blank">{{ $documents[$value] }}</a>
                                  {{ Form::hidden('old_'.$value,$documents[$value])  }}
                                @endif
                            </div>
                        </div>
    					@endif
					@endforeach
                @if($requisition->status == 'completed')
                	<div class="panel-content">
    				<div class="form-group">
                        <div class="col-md-6 col-md-offset-2">
                        	<button type="submit" name="docupdate" value="docupdate" class="btn btn-primary">
                            	Upload Deed Paper
                        	</button>
                        </div>
                    </div>
                </div>
                @else
    				@if(!$requisition->doc_verified)
                    <div class="panel-content">
    					<div class="form-group">
                            <div class="col-md-6 col-md-offset-2">
                                <button type="submit" name="verified" value="verified" class="btn btn-primary">
                                	Verified
                            	</button>
                                 <button type="submit" name="notVerified" value="notVerified" class="btn btn-primary">
                                	Not Verified
                            	</button>
                            	<button type="submit" name="docupdate" value="docupdate" class="btn btn-primary">
                                	Update Document
                            	</button>
                            </div>
                        </div>
                    </div>
                	@elseif($requisition->doc_verified == 'no')
                    <div class="panel-content">
    					<div class="form-group">
                            <div class="col-md-6 col-md-offset-2">
                                <button type="submit" name="verified" value="verified" class="btn btn-primary">
                                	Verified
                            	</button>
                            	<button type="submit" name="docupdate" value="docupdate" class="btn btn-primary">
                                	Update Document
                            	</button>
                            </div>
                        </div>
                    </div>
                @else
                <div class="panel-content">
    				<div class="form-group">
                        <div class="col-md-6 col-md-offset-2">
                        	<button type="submit" name="docupdate" value="docupdate" class="btn btn-primary">
                            	Update Document
                        	</button>
                        </div>
                    </div>
                </div>
                @endif
            @endif  
            {{ Form::close() }}
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
 