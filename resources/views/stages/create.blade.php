@extends('layouts.admin')
@section('title', 'Add Stage')
@section('content')
@php
    $module=request()->route()->parameters['modules'];
    $configStageArr = array_keys(config('myconfig.staging'));
    $stageArr = array_combine($configStageArr,array_map('mystudy_case',$configStageArr));
@endphp
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Stage</a></li>
            <li><a>Add</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Stage Add For <span class="text-capitalize">{{ mystudy_case($module) }}</span></b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('stages.index','<i class="fa fa-list"></i>',[$module],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">
				{{ Form::model(request()->old(),array('route' => array('stages.store',$module),'enctype'=>'multipart/form-data','class'=>'form-horizontal')) }}

                    <div class="form-group{{ $errors->has('module_name') ? ' has-error' : '' }}">
                        {{Form::label('module_name:',null,array('class' => 'control-label col-sm-2 require'))}}
                        <div class="col-md-6">
                            {{Form::select('module_name',$stageArr,request()->route()->parameters?:null,array('onchange'=>"changeStage(this.value)",'class' => 'form-control text-capitalize'))}}
                            {!! $errors->first('module_name', '<p class="text-danger">:message</p>' ) !!}
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
                        <div class="col-md-6 mb-sm">
                            <div class="checkbox-inline controller checkbox">
                            	 <label>
                            		{{ Form::checkbox("data[$loop->iteration][designation_id]",$key,null,array('onchange'=>'permission_select_deselect_child(this)','id'=>'check-'.$key,'class'=>'parent_'.$key)) }}
                                 	<strong>{{ $val }} </strong>
								</label>
                            </div>
                            <div class="checkbox-inline b-sm pr-sm pt-0 action-wraper">
                                @foreach (config('myconfig.staging.'.$module) as $ke=>$ele)
                                    <div class="checkbox-inline actions checkbox">
                                    	<label class="check text-capitalize">
                                    		{{Form::checkbox('data['.$loop->parent->iteration.'][actions]['.$ele.']',$ele,null,array('onchange'=>'permission_select_parent('.$key.')','id'=>'child'.$ke.'-'.$key,'class'=>$key))}}
                                        	{{ $ele }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                    </div>

					<div class="form-group">
                        <div class="col-md-6 col-md-offset-2">
                            <button type="submit" class="btn btn-primary">
                                ADD
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

@section('script')
	<script>
    	function changeStage(stage){
        	window.location.href = laravelObj.appHost + '/stages/'+stage+'/create';
    	}

	</script>
@stop

