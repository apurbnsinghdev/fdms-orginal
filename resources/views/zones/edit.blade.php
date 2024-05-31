@extends('layouts.admin')
@section('title', 'Update Zone')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Zone</a></li>
            <li><a>Update</a></li>
        </ul>
    </div>
</div>
@include('zones.tab')
	@php
		$labelName = 'Region';
	@endphp
    @if ($param=='1')
    	@php
    		$labelName = 'Area';
    	@endphp
    @endif
<div class="row animated fadeInRight">
    <div class="col-sm-12">
        @include('zones.subtitle')
        <span class="pull-right">
            {!! Html::decode(link_to_route('zones.index','<i class="fa fa-list"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">
                {{ Form::model($zones,array('route' => array('zones.update',$zones->id),'method' => 'PUT','enctype'=>'multipart/form-data','class'=>'form-horizontal')) }}

                    {{Form::hidden('level',$param)}}

                    @if ($param=='1')
                        <div class="form-group{{ $errors->has('parent_id') ? ' has-error' : '' }}">
                            {{Form::label('Region:',null,array('class' => 'control-label col-sm-2 require'))}}
                            <div class="col-md-6">
                                {{Form::select('parent_id',$regions,null,array('class' => 'form-control'))}}
                                {!! $errors->first('parent_id', '<p class="text-danger">:message</p>' ) !!}
                            </div>
                        </div>
                    @endif

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                       {{Form::label($labelName. ' name:',null,array('class' => 'control-label col-sm-2 require'))}}
                        <div class="col-md-6">
                            {{Form::text('name',null,array('class' => 'form-control'))}}
                            {!! $errors->first('name', '<p class="text-danger">:message</p>' ) !!}
                        </div>
                    </div>

                    @if (!$param)
                        <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                            {{Form::label($labelName.' code:',null,array('class' => 'control-label col-sm-2 require'))}}
                            <div class="col-md-6">
                                {{Form::text('code',null,array('class' => 'form-control'))}}
                                {!! $errors->first('code', '<p class="text-danger">:message</p>' ) !!}
                            </div>
                        </div>
                    @endif

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

