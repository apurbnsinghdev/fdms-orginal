@extends('layouts.admin')
@section('title', 'Stage Lists')
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
            <li><a>Lists</a></li>
        </ul>
    </div>
</div>
@include('stages.tab')
<div class="row animated fadeInRight">
    <div class="col-sm-12">
      @if ($stages->count())
       <h4 class="section-subtitle"><b>Stage Lists For <span class="text-capitalize">{{ mystudy_case($module) }}</span></b></h4>
       @else
        <h4 class="section-subtitle text-danger text-capitalize"><b>No stage is created in <span class="text-capitalize">{{ mystudy_case($module) }}</span></b></h4>
      @endif

        <span class="pull-right">
           {{Form::select('module_name',$stageArr,$module,array('onchange'=>"changeStage(this.value)",'class' => 'module_dropdown text-capitalize'))}}
            {!! Html::decode(link_to_route('stages.create','<i class="fa fa-plus"></i>',[$module],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>

      @if ($stages->count())
        <div class="panel">
            <div class="panel-content">
              <div class="row">
              	@foreach($stages as $value)
                <div class="col-md-6">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th class="text-center">SL</th>
                        <th>{{$value->name}}</th>
                        <th>Actions</th>
                        <th>
				           {!! Html::decode(link_to_route('stages.edit', '<i aria-hidden="true" class="fa fa-edit fa-x"></i>', array($module,$value->id))) !!}
				           {!! Form::delete(route('stages.destroy',array($module,$value->id)),'<i aria-hidden="true" class="fa fa-remove"></i>') !!}
                        </th>
                      </tr>
                    </thead>

                    <tbody>
                    @foreach($value['stage_details'] as $vl)
                      <tr>
                        <td class="text-center">{{$loop->iteration}}</td>
                        <td>{{$vl->designation->short_name or ''}}</td>
                        <td class="text-capitalize">
                        	@php
                        		$actionsArr = json_decode($vl->actions,true);
                        	@endphp
                        	@if(count($actionsArr) > 0)
                        		{{implode(',',$actionsArr)}}
                        	@else
                        		{{'view'}}
                        	@endif
                        </td>
                        <td class="text-center">
                           	{!! Form::delete(route('stage.details.untag',array($module,$vl->id,$value->id)),'<i aria-hidden="true" class="fa fa-minus"></i>') !!}
                        </td>
                      </tr>
                     @endforeach
                    </tbody>
                  </table>
                </div>
                @endforeach
              </div>
            </div>
        </div>
      @endif

    </div>
</div>
@endsection
@section('script')
	<script>
    	function changeStage(stage){
        	window.location.href = laravelObj.appHost + '/stages/'+stage;
    	}
	</script>
@stop
@section('css')
<style>
   .module_dropdown{
      display: inline-block;
      height: 34px;
      padding: 6px 12px;
      font-size: 14px;
      line-height: 1.42857143;
      color: #555555;
      background-color: #fff;
      background-image: none;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
</style>
@stop


