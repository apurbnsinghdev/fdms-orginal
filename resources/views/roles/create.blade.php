@extends('layouts.admin')
@section('title', 'Create Roles')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Roles</a></li>
            <li><a>Add</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Create Role</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('roles.index','<i class="fa fa-list"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">
				{{ Form::model(Request::old(),array('route' => array('roles.store'),'class'=>'form-horizontal')) }}
				<div class="row">
					<div class="col-md-12">
						<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
							<label class="control-label col-md-2 require">Role Name :</label>
							 <div class="col-md-6">
								<input type="text" name="name" class="form-control" required="required">
				                {!! $errors->first('name', '<p class="text-danger">:message</p>' ) !!}
							</div>
						</div>
				        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
							<label class="control-label col-md-2 require">Role Description :</label>
							 <div class="col-md-6">
				             <textarea name="description" class="form-control" placeholder="maximum length should be 600"></textarea>
				             <small>(maximum length should be 600)</small>
				              {!! $errors->first('description', '<p class="text-danger">:message</p>' ) !!}
							</div>
						</div>
				        <div class="form-group">
							<label class="control-label col-md-2">Status :</label>
							 <div class="col-md-6">
				                {{Form::select('status',config('myconfig.status'),null,array('class' => 'form-control')) }}
							</div>
						</div>
						 <div class="form-group">
                            <label for="righticon" class="col-sm-2 control-label">&nbsp;</label>
                            <div class="col-sm-5">
                                <div class="checkbox-custom checkbox-success">
                                    <input type="checkbox" id="checkboxCustom3" name="can_apply" value="1">
                                    <label for="checkboxCustom3" class="check">Can Apply ?</label>
                                </div>
                            </div>
                        </div>
			    	</div>
				</div>
				@php
					$controllersArray = array_chunk($permission, 4, true);
				@endphp

				<div class="panel-header">
					<h4 class="panel-title">Permission Setting:</h4>
				</div>
				<label style="border:1px solid #ddd; padding:5px; margin-top: 10px; background-color: #efefef">
					<input id="checkoruncheck" type="checkbox" checked="checked">
					<strong>Check/Uncheck All</strong>
				</label>
				@foreach ($controllersArray as $elements)
				<div class="row">
					@foreach ($elements as $key=>$elements)
						<div class="col-md-3">
							<div class="checkbox controller">
							    <label>
							    	<input name="{{ $key }}" class="parent_{{ $key }}" type="checkbox" checked="true" value="{{ array_search($key, $parents) }}" onChange="permission_select_deselect_child(this)">
							    	<strong>{{ $key }} </strong>
							    </label>
							</div>
							<div class="action-wraper">
								@foreach ($elements as $key2=>$element)
								  <div class="checkbox actions" style="margin-left:20px;">
								    <label><input name="{{ $key2 }}" class="{{ $key }}" type="checkbox" checked="true" value="{{ $key2 }}" onChange="permission_select_parent('{{ $key }}')"> {{ mystudy_case(snake_case($element)) }}</label>
								  </div>
								@endforeach
							</div>
						</div>
					@endforeach
				</div>
				@endforeach
				<div class="row">
					<div class="col-md-12">
		                <button type="submit" class="btn btn-primary">
		                    Create Role
		                </button>
					</div>
				</div>
				{{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
$(document).ready(function(e){
	$("#checkoruncheck").change(function () {
	    $("input:checkbox").not('#checkboxCustom3').prop('checked', $(this).prop("checked"));
	});
});
</script>
@stop