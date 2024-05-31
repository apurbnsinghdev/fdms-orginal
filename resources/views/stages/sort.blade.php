@extends('layouts.admin')
@section('title', 'Stage Sort')
@section('content')
@php
  $module=request()->route()->parameters['modules'];
  $stageArr = array_keys(config('myconfig.staging'));
  $stageArr = array_combine($stageArr,array_map('mystudy_case',$stageArr));
 
@endphp
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Stage</a></li>
            <li><a>Sort</a></li>
        </ul>
    </div>
</div>

@include('stages.tab')

<div class="row animated fadeInRight">

    <div class="col-sm-12">
      @if ($stages->count())
        <h4 class="section-subtitle"><b>Stage Sorting For <span class="text-capitalize">{{ mystudy_case($module) }}</span></b></h4>
      @else
        <h4 class="section-subtitle text-danger text-capitalize"><b>There is no data for <span class="text-capitalize">{{ mystudy_case($module) }}</span></b></h4>
      @endif

        <span class="pull-right">
          {{Form::select('module_name',$stageArr,$module,array('onchange'=>"changeStage(this.value)",'class' => 'module_dropdown text-capitalize'))}}
         {!! Html::decode(link_to_route('stages.create','<i class="fa fa-plus"></i>',[$module],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
    </div>

    <div class="col-sm-12">
      @if ($stages->count())
      {{ Form::model([],array('route' => array('stages.sort',$module),'method' => 'PUT')) }}
        <ul id="sortable">
          @foreach ($stages as $key=>$val)
          <li class="ui-state-default">
            <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
            <input type="hidden" name="sort[]" value="{{ $key }}">{{ $val }}
          </li>
          @endforeach
        </ul>
        <div class="form-group">
          <button type="submit" class="btn btn-primary mt-sm">
              Sort Stage For <span class="text-capitalize">{{ mystudy_case($module) }}</span>
          </button>
        </div>
      {{ Form::close() }}
      @endif
    </div>
</div>
@endsection

@section('script')
  <script src="{{ asset('js/jquery-ui.js') }}"></script>
  <script>
    $( function() {
      $( "#sortable" ).sortable();
      $( "#sortable" ).disableSelection();
    });
     function changeStage(stage){
          window.location.href = laravelObj.appHost + '/stage-sorting/'+stage;
      }
  </script>
@stop

@section('css')
  <style>
    #sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
    #sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; cursor: pointer; }
    #sortable li span { margin-left: -1.3em; }
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
  <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
@stop

