@extends('layouts.admin')
@section('title', 'Update Site Settings')
@section('content')
<div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Site Setting</a></li>
            <li><a>Update</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Site Setting Update</b></h4>
        <div class="panel">
            <div class="panel-content">
 			{{ Form::model($site_settings,array('route' => array('site_settings.update',$site_settings->id),'enctype'=>'multipart/form-data','method' => 'PUT','class'=>'form-horizontal')) }}
				<div class="form-group">
					{{Form::label('Site Title:',null,array('class' => 'control-label col-sm-2 require'))}}
					<div class="col-md-6">
					{{Form::text('site_title',null,array('class' => 'form-control'))}}
		            {!! $errors->first('site_title', '<p class="text-danger">:message</p>' ) !!}
					</div>
				</div>
				<div class="form-group">
					{{Form::label('Site Author:',null,array('class' => 'control-label col-sm-2 require'))}}
					<div class="col-md-6">
					{{Form::text('site_author',null,array('class' => 'form-control'))}}
		            {!! $errors->first('site_author', '<p class="text-danger">:message</p>' ) !!}
					</div>
				</div>
				<div class="form-group">
					{{Form::label('Email Address:',null,array('class' => 'control-label col-sm-2 require'))}}
					<div class="col-md-6">
					{{Form::text('author_email',null,array('class' => 'form-control'))}}
		            {!! $errors->first('author_email', '<p class="text-danger">:message</p>' ) !!}
					</div>
				</div>
				<div class="form-group">
					{{Form::label('Address:',null,array('class' => 'control-label col-sm-2'))}}
					<div class="col-md-6">
					{{Form::textarea('address',null,array('class' => 'form-control'))}}
					</div>
				</div>
				<div class="form-group">
					{{Form::label('Phone:',null,array('class' => 'control-label col-sm-2'))}}
					<div class="col-md-6">
					{{Form::text('phone',null,array('class' => 'form-control'))}}
					</div>
				</div>
				<div class="form-group">
					{{Form::label('Fax:',null,array('class' => 'control-label col-sm-2'))}}
					<div class="col-md-6">
					{{Form::text('fax',null,array('class' => 'form-control'))}}
					</div>
				</div>
				<div class="form-group">
					{{Form::label('Web:',null,array('class' => 'control-label col-sm-2'))}}
					<div class="col-md-6">
					{{Form::text('web',null,array('class' => 'form-control'))}}
					</div>
				</div>
				<div class="form-group">
					{{Form::label('Company Logo:',null,array('class' => 'control-label col-sm-2'))}}
					<div class="col-md-6">
		                {{Form::file('logo',array('onChange'=>'readURL(this)'))}}
		                {!! $errors->first('logo', '<p class="text-danger">:message</p>' ) !!}
		                {{ Form::hidden('old_image',$site_settings->logo)  }}
					</div>
		            <div class="col-md-2 preview-div">
		            	@if(file_exists(public_path().'/storage/images/'.$site_settings->logo))
							{{ Html::image('storage/images/'.$site_settings->logo,null,array('class'=>'img-responsive')) }}
						@endif
					</div>
				</div>
	            <div class="form-group">
	                <div class="col-md-6 col-md-offset-2">
	                    <button type="submit" class="btn btn-primary">
	                        Update Settings
	                    </button>
	                </div>
	            </div>
 			{{ Form::close() }}
			</div>
		</div>
	</div>
</div>
@endsection