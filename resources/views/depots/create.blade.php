@extends('layouts.admin')
@section('title', 'Add Depot')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Depot</a></li>
            <li><a>Add</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">

    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Depot Add</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('depots.index','<i class="fa fa-list"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">
				{{ Form::model(request()->old(),array('route' => array('depots.store'),'enctype'=>'multipart/form-data','class'=>'form-horizontal')) }}

                    @include('common_pages.location_zone_dropdown_add')

                    <div class="row mb-md">
                        <div class="col-md-12">
                            <hr>
                            <div class="form-group">
                                {{Form::label('',null,array('class' => 'control-label col-sm-2'))}}
                                <div class="col-md-8 checkbox-custom checkbox-success">
                                   {{Form::checkbox('has_incharge',1,null,['id'=>'has_incharge'])}}
                                   {{Form::label('has_incharge',null,array('for'=>'has_incharge','class' => 'check'))}}
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                {{Form::label('depot name:',null,array('class' => 'control-label col-sm-2 require'))}}
                                <div class="col-md-8">
                                    {{Form::text('name',null,array('class' => 'form-control'))}}
                                    {!! $errors->first('name', '<p class="text-danger">:message</p>' ) !!}
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                                {{Form::label('depot code:',null,array('class' => 'control-label col-sm-2 require'))}}
                                <div class="col-md-8">
                                    {{Form::text('code',null,array('class' => 'form-control'))}}
                                    {!! $errors->first('code', '<p class="text-danger">:message</p>' ) !!}
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                {{Form::label('address:',null,array('class' => 'control-label col-sm-2'))}}
                                <div class="col-md-8">
                                    {{Form::textarea('address',null,array('class' => 'form-control'))}}
                                </div>
                            </div>
                        </div>
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
@section('vuescript')
<script>
    laravelObj.division_id='{{ old('division_id') }}';
    laravelObj.district_id='{{ old('district_id') }}';
    laravelObj.thana_id='{{ old('thana_id') }}';
    laravelObj.region_id='{{ old('region_id') }}';
    laravelObj.area_id='{{ old('area_id') }}';
</script>
@stop
