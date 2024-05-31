@extends('layouts.admin')
@section('title', 'Add DF Size')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Size</a></li>
            <li><a>Add</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">

    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>DF Size Add</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('sizes.index','<i class="fa fa-list"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">
				{{ Form::model(request()->old(),array('route' => array('sizes.store'),'enctype'=>'multipart/form-data','class'=>'form-horizontal')) }}

					<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
						{{Form::label('DF Size:',null,array('class' => 'control-label col-sm-2 require'))}}
						<div class="col-md-6">
			                {{Form::number('name',null,array('class' => 'form-control'))}}
			                {!! $errors->first('name', '<p class="text-danger">:message</p>' ) !!}
						</div>
					</div>

                    <div class="form-group">
                        {{Form::label('rent_amount:',null,array('class' => 'control-label col-sm-2 require'))}}
                        <div class="col-md-6">
                            {{Form::number('rent_amount',null,array('class' => 'form-control'))}}
                            {!! $errors->first('rent_amount', '<p class="text-danger">:message</p>' ) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {{Form::label('installment:',null,array('class' => 'control-label col-sm-2 require'))}}
                        <div class="col-md-6">
                            {{Form::number('installment',null,array('class' => 'form-control'))}}
                            {!! $errors->first('installment', '<p class="text-danger">:message</p>' ) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {{Form::label('availability:',null,array('class' => 'control-label col-sm-2'))}}
                        <div class="col-md-6">
                            {{Form::select('availability',config('myconfig.availability'),null,array('class' => 'form-control'))}}
                            {!! $errors->first('availability', '<p class="text-danger">:message</p>' ) !!}
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