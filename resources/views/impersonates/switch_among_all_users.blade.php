@extends('layouts.admin')
@section('title', 'Sync User')
@section('content')

<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Switch To</a></li>
            <li><a>All Users</a></li>
        </ul>
    </div>
</div>

<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Users list for switching</b></h4>
        <div class="panel">
        	<div class="panel-content">
				{{ Form::model(request()->old(),array('route' => array('users.SwitchAmongAllUsers'),'method' => 'PUT','class'=>'form-horizontal')) }}

                     <div class="form-group">
                        {{Form::label('user_id:',null,array('class' => 'control-label col-sm-2 require'))}}
                        <div class="col-md-6">
                            {{Form::select('user_id',$users,null,array('class' => 'form-control select2'))}}
                            {!! $errors->first('user_id', '<p class="text-danger">:message</p>' ) !!}
                        </div>
                    </div>

					<div class="form-group">
                        <div class="col-md-6 col-md-offset-2">
                            <button type="submit" class="btn btn-primary">
                                Switch
                            </button>
                        </div>
                    </div>
				{{ Form::close() }}
            </div>
		</div>
    </div>
</div>
@endsection
@component('common_pages.selectize')@endcomponent
