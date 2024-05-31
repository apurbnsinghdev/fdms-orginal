@extends('layouts.admin')
@section('title', 'Add Technician')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Technician</a></li>
            <li><a>Add</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">

    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Technician Add</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('technicians.index','<i class="fa fa-list"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">
				{{ Form::model(request()->old(),array('route' => array('technicians.store'),'enctype'=>'multipart/form-data','class'=>'form-horizontal')) }}
					<div class="form-group{{ $errors->has('depot_id') ? ' has-error' : '' }}">
						{{Form::label('depot:',null,array('class' => 'control-label col-sm-2 require'))}}
						<div class="col-md-6">
			                {{Form::select('depot_id',['' => 'Please Select ..']+ $depots->toArray(),null,array('class' => 'form-control select2','data-placeholder'=>'Please Select Depot'))}}
			                {!! $errors->first('depot_id', '<p class="text-danger">:message</p>' ) !!}
						</div>
					</div>
					<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
						{{Form::label('name:',null,array('class' => 'control-label col-sm-2 require'))}}
						<div class="col-md-6">
			                {{Form::text('name',null,array('class' => 'form-control'))}}
			                {!! $errors->first('name', '<p class="text-danger">:message</p>' ) !!}
						</div>
					</div>
					<div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
						{{Form::label('mobile:',null,array('class' => 'control-label col-sm-2 require'))}}
						<div class="col-md-6">
			                {{Form::text('mobile',null,array('class' => 'form-control max-length','maxlength'=>11))}}
			                {!! $errors->first('mobile', '<p class="text-danger">:message</p>' ) !!}
						</div>
					</div>
					<div class="form-group">
                        <label for="status" class="col-md-2 control-label require">Status</label>
                        <div class="col-md-6">
                        {{Form::select('status',config('myconfig.status'),null,array('class' => 'form-control'))}}
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
@component('common_pages.selectize') 
 @include('common_pages.max_length')
@endcomponent