@extends('layouts.admin')
@section('title', 'Sync User')
@section('content')

<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Users</a></li>
            <li><a>Sync User</a></li>
        </ul>
    </div>
</div>

<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Sync User</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('users.syncList','<i class="fa fa-list"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
        	<div class="panel-content">
				{{ Form::model(request()->old(),array('route' => array('users.syncCreate'),'method' => 'PUT','class'=>'form-horizontal')) }}

                     <div class="form-group">
                        {{Form::label('user_from:',null,array('class' => 'control-label col-sm-2 require'))}}
                        <div class="col-md-6">
                            {{Form::select('user_from',$users,null,array('class' => 'form-control select2'))}}
                            {!! $errors->first('user_from', '<p class="text-danger">:message</p>' ) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {{Form::label('user_to:',null,array('class' => 'control-label col-sm-2 require'))}}
                        <div class="col-md-6">
                            {{Form::select('user_to',$users,null,array('class' => 'form-control select2'))}}
                            {!! $errors->first('user_to', '<p class="text-danger">:message</p>' ) !!}
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('common_username') ? ' has-error' : '' }}">
						{{Form::label('common_username',null,array('class' => 'control-label col-sm-2 require'))}}
						<div class="col-md-6">
			                {{Form::text('common_username',null,array('class' => 'form-control max-length','autocomplete'=>'off','maxlength'=>25))}}
			                {!! $errors->first('common_username', '<p class="text-danger">:message</p>' ) !!}
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
