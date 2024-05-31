@extends('layouts.admin')
@section('title', 'Update Stage')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Stage</a></li>
            <li><a>Update</a></li>
        </ul>
    </div>
</div>
@php
	$actionByDesignation = $stages->stage_details->pluck('actions','designation_id');
@endphp
<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Stage Lists</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('stages.index','<i class="fa fa-list"></i>',[$stages->module],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">

				{{ Form::model($stages,array('route' => array('stages.update',$stages->module,$stages->id),'method'=>'PUT','class'=>'form-horizontal')) }}
                    <div class="form-group">
                        {{Form::label('Module:',null,array('class' => 'control-label col-sm-2'))}}
                        <div class="col-md-6 pt-sm">
                            {{ mystudy_case($stages->module) }}
                        </div>
                    </div>
					<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
						{{Form::label('stage_name:',null,array('class' => 'control-label col-sm-2 require'))}}
						<div class="col-md-6">
			                {{Form::text('name',null,array('class' => 'form-control'))}}
			                {!! $errors->first('name', '<p class="text-danger">:message</p>' ) !!}
						</div>
					</div>
                    <div class="panel-header">
                        <h4 class="panel-title">Assign Designation:</h4>
                    </div>


                    <div class="row mt-sm">
                    @foreach ($designations as $key=>$val)
                    	@php
                    		$actions = $actionByDesignation->pull($key)
                    	@endphp
                    	@if($actions)
                    		@php
                    			 $actionsArr = json_decode($actions,true);
                    		@endphp
                        <div class="col-md-6 mb-sm">
                            <div class="checkbox-inline controller checkbox">
                            	<label>
                                	{{ Form::checkbox("data[$loop->iteration][designation_id]",$key,$key,array('onchange'=>'permission_select_deselect_child(this)','id'=>'check-'.$key,'class'=>'parent_'.$key)) }}
                                     <strong>{{ $val }} </strong>
								</label>

                            </div>
                            <div class="checkbox-inline b-sm pr-sm pt-0 action-wraper">
                                @foreach (config('myconfig.staging.'.$stages->module) as $ke=>$ele)
                                    <div class="checkbox-inline actions checkbox">
                                    	<label class="text-capitalize">
                                    	@if(in_array($ele, $actionsArr))
                                    		{{Form::checkbox('data['.$loop->parent->iteration.'][actions]['.$ele.']',$ele,$ele,array('onchange'=>'permission_select_parent('.$key.')','id'=>'child'.$ke.'-'.$key,'class'=>$key))}}
                                    	@else
                                    		{{Form::checkbox('data['.$loop->parent->iteration.'][actions]['.$ele.']',$ele,null,array('onchange'=>'permission_select_parent('.$key.')','id'=>'child'.$ke.'-'.$key,'class'=>$key))}}
                                    	@endif
                                        {{ $ele }}
                                      </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @else
                        <div class="col-md-6 mb-sm">
                            <div class="checkbox-inline controller checkbox">
                            <label>
                            	{{ Form::checkbox("data[$loop->iteration][designation_id]",$key,null,array('onchange'=>'permission_select_deselect_child(this)','id'=>'check-'.$key,'class'=>'parent_'.$key)) }}
                            	 <strong>{{ $val }} </strong>
                              </label>

                            </div>
                            <div class="checkbox-inline b-sm pr-sm pt-0 action-wraper">
                                @foreach (config('myconfig.staging.'.$stages->module) as $ke=>$ele)
                                    <div class="checkbox-inline actions checkbox">
                                    	<label class="text-capitalize">
                                    	{{Form::checkbox('data['.$loop->parent->iteration.'][actions]['.$ele.']',$ele,null,array('onchange'=>'permission_select_parent('.$key.')','id'=>'child'.$ke.'-'.$key,'class'=>$key))}}

                                        {{ $ele }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    @endforeach
                    </div>

					<div class="form-group">
                        <div class="col-md-6 col-md-offset-2">
                            <button type="submit" class="btn btn-primary">
                                UPDATE
                            </button>
                        </div>
                    </div>
				{{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
@section('css')
<style>
    .checkbox-inline{
        padding-top: 3px !important;
        padding-left: 3px !important;
    }
</style>
@stop


