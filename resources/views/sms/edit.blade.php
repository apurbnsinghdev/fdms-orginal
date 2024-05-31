@extends('layouts.admin')
@section('title', 'Update SMS')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">SMS</a></li>
            <li><a>Update</a></li>
        </ul>
    </div>
</div>

<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>SMS Lists</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('sms.index','<i class="fa fa-list"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">
                {{ Form::model($sms,array('route' => array('sms.edit',$sms->id),'method' => 'PUT','enctype'=>'multipart/form-data','class'=>'form-horizontal')) }}
                	<div class="form-group">
                        {{Form::label('Subject.:',null,array('class' => 'control-label col-sm-2'))}}
                        <div class="col-md-6 pt-sm">
                            <strong>{{mystudy_case($sms->subject)}}</strong>
                        </div>
                    </div>
                	@if($sms->is_designation_wise)
                	@php
                		$selectedDesignations = [];
                		if($sms->designations){
                			$selectedDesignations = json_decode($sms->designations,true);
                		}
                		
                	@endphp
           			<div class="form-group">
                        <label for="status" class="col-md-2 control-label">Designations: </label>
                        <div class="col-md-8">
                            <div class="row">
                                @foreach ($designations as $key => $value)
                                <div class="col-md-6 input-container">
                                    <label><input name="designations[]" id="" type="checkbox" value="{{$key}}" @if(in_array($key,$selectedDesignations)) checked  @endif><strong>{{$value}}</strong></label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
					@endif
                     <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                        {{Form::label('status.:',null,array('class' => 'control-label col-sm-2'))}}
                        <div class="col-md-6">
                            {{Form::select('status',config('myconfig.status'),null,array('class' => 'form-control'))}}
                            {!! $errors->first('status', '<p class="text-danger">:message</p>' ) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-2">
                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection

