@extends('layouts.admin')
@section('title', 'Add DF Size')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Send</a></li>
            <li><a>SMS</a></li>
        </ul>
    </div>
</div>
@php
	$oldRequest = request()->old();
	$depotOldRequest =  $oldRequest['depots'] ?? [];
	$receiverGroupOldRequest =  $oldRequest['receiver_group'] ?? [];
@endphp
<div class="row animated fadeInRight">

    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Send SMS To {{mystudy_case($param)}}</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('smsPromotionals.index','<i class="fa fa-list"></i>',[$param],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">
				{{ Form::model(request()->old(),array('route' => array('smsPromotionals.send',$param),'enctype'=>'multipart/form-data','class'=>'form-horizontal')) }}
					<div class="form-group {{ $errors->has('depots') ? ' has-error' : '' }}">
                        <label for="righticon" class="col-sm-2 control-label require">Depot:</label>
                        <div class="col-sm-10">
                        	@foreach($depots as $key => $value)
                        		@php
                        			$checked = '';
                        			if(in_array($key,$depotOldRequest)){
                        				$checked = 'checked';
                        			}
                        		@endphp
                            <div class="checkbox-custom checkbox-inline checkbox-success">
                                <input type="checkbox" id="depots{{$key}}" name="depots[]" value="{{$key}}" {{$checked}}>
                                <label class="check" for="depots{{$key}}">{{$value}}</label>
                            </div>
                            @endforeach
                            {!! $errors->first('depots', '<p class="text-danger">:message</p>' ) !!}
                        </div>
                        
                    </div>
                    @if($param == 'sales_team')
                    <div class="form-group {{ $errors->has('receiver_group') ? ' has-error' : '' }}">
                        <label for="righticon" class="col-sm-2 control-label require">Designations:</label>
                        <div class="col-sm-10">
                        	@foreach($designations as $key => $value)
                        		@php
                        			$checked = '';
                        			if(in_array($key,$receiverGroupOldRequest)){
                        				$checked = 'checked';
                        			}
                        		@endphp
                            <div class="checkbox-custom checkbox-inline checkbox-success">
                                <input type="checkbox" id="receiver_group{{$key}}" name="receiver_group[]" value="{{$key}}" {{$checked}}>
                                <label class="check" for="receiver_group{{$key}}">{{$value}}</label>
                            </div>
                            @endforeach
                            {!! $errors->first('receiver_group', '<p class="text-danger">:message</p>' ) !!}
                        </div>
                    </div>
                    @endif
                    @if($param == 'outlets')
                    <div class="form-group {{ $errors->has('receiver_group') ? ' has-error' : '' }}">
                        <label for="righticon" class="col-sm-2 control-label require">Outlets:</label>
                        <div class="col-sm-10">
                            <div class="checkbox-custom checkbox-inline checkbox-success">
                                <input type="checkbox" id="receiver_group1" name="receiver_group[]" value="1" @if(in_array(1,$receiverGroupOldRequest)) checked @endif >
                                <label class="check" for="receiver_group1">Currently Injected</label>
                            </div>
                            <div class="checkbox-custom checkbox-inline checkbox-success">
                                <input type="checkbox" id="receiver_group2" name="receiver_group[]" value="2" @if(in_array(2,$receiverGroupOldRequest)) checked @endif >
                                <label class="check" for="receiver_group2">Active</label>
                            </div>
                            {!! $errors->first('receiver_group', '<p class="text-danger">:message</p>' ) !!}
                        </div>
                    </div>
                    @endif
					<div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
						{{Form::label('Subject:',null,array('class' => 'control-label col-sm-2 require'))}}
						<div class="col-md-6">
			                {{Form::text('subject',null,array('class' => 'form-control'))}}
			                {!! $errors->first('subject', '<p class="text-danger">:message</p>' ) !!}
						</div>
					</div>
 					<div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
						{{Form::label('Message:',null,array('class' => 'control-label col-sm-2 require'))}}
						<div class="col-md-6">
			                {{Form::textarea('message',null,array('class' => 'form-control max-length','maxlength'=>320))}}
			                {!! $errors->first('message', '<p class="text-danger">:message</p>' ) !!}
						</div>
					</div>
					<div class="form-group">
                        <div class="col-md-6 col-md-offset-2">
                            <button type="submit" class="btn btn-primary">
                                Send
                            </button>
                        </div>
                    </div>
				{{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
	@include('common_pages.max_length')
@stop