@extends('layouts.admin')
@section('title', 'Add Distributor')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Distributor</a></li>
            <li><a>Import</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">

    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Distributor Import</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('shops.index','<i class="fa fa-list"></i>',[1],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">
				{{ Form::model(request()->old(),array('route' => array('uploads.shops'),'enctype'=>'multipart/form-data','class'=>'form-horizontal')) }}
  					<div class="form-group">
                        {{Form::label('Browse Distributor:',null,array('class' => 'control-label col-sm-2'))}}
                        <div class="col-md-6">
                            {{Form::file('file')}}
                            {!! $errors->first('file', '<p class="text-danger">:message</p>' ) !!}
                        </div>
                        <div class="col-md-2 preview-div">
                        </div>
                    </div>
					<div class="form-group">
                        <div class="col-md-6 col-md-offset-2">
                            <button type="submit" class="btn btn-primary" name="btnDistributor">
                                Upload Distributor
                            </button>
                        </div>
                    </div>
				{{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection