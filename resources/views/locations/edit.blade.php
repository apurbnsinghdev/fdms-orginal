@extends('layouts.admin')
@section('title', 'Update Location')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Location</a></li>
            <li><a>Update</a></li>
        </ul>
    </div>
</div>
@include('locations.tab')
<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Location Lists</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('locations.index','<i class="fa fa-list"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">
                {{ Form::model($locations,array('route' => array('locations.update',$locations->id),'method' => 'PUT','enctype'=>'multipart/form-data','class'=>'form-horizontal')) }}

                    {{Form::hidden('level',$param)}}

                    @if ($param=='1')
                        <div class="form-group{{ $errors->has('parent_id') ? ' has-error' : '' }}">
                            {{Form::label('Division:',null,array('class' => 'control-label col-sm-2 require'))}}
                            <div class="col-md-6">
                                {{Form::select('parent_id',$divisions,null,array('class' => 'form-control'))}}
                                {!! $errors->first('parent_id', '<p class="text-danger">:message</p>' ) !!}
                            </div>
                        </div>
                    @elseif($param=='2')
                        <div class="form-group">
                            {{Form::label('Division:',null,array('class' => 'control-label col-sm-2'))}}
                            <div class="col-md-6">
                                {{Form::select('division_id',[''=>'Please Select Division']+$divisions->toArray(),$locations->parent->parent_id,array('class' => 'form-control','v-model'=>'division_id', '@change'=>'getDistricts'))}}
                            </div>
                        </div>
                         <div class="form-group{{ $errors->has('parent_id') ? ' has-error' : '' }}">
                            {{Form::label('District:',null,array('class' => 'control-label col-sm-2 require'))}}
                            <div class="col-md-6">
                                <select name="parent_id" class="form-control col-sm-2" v-model="district_id">
                                    <option value="">Please Select District</option>
                                    <option v-for="(name,id) in districts" v-bind:value="id" v-text="name"></option>
                                </select>
                            </div>
                        </div>
                    @endif

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        {{Form::label('name:',null,array('class' => 'control-label col-sm-2 require'))}}
                        <div class="col-md-6">
                            {{Form::text('name',null,array('class' => 'form-control'))}}
                            {!! $errors->first('name', '<p class="text-danger">:message</p>' ) !!}
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
@section('vuescript')
@if($param=='2')
    <script>
        laravelObj.division_id='{{ $locations->parent->parent_id or '' }}';
        laravelObj.districts=JSON.parse('{!! $districts or '' !!}');
        laravelObj.district_id='{{ $locations->parent_id or '' }}';
    </script>
@endif
@stop
