@extends('layouts.admin')
@section('title', 'Edit Roles')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Roles</a></li>
            <li><a>Update</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Role Update</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('roles.index','<i class="fa fa-list"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
        	<div class="panel-content">
        		{{ Form::model($roles,array('route' => array('roles.update', $roles->id),'class'=>'form-horizontal','method' => 'PUT')) }}
			<div class="row">
				<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
					<label class="control-label col-sm-2 require">Role Name :</label>
					 <div class="col-md-6">
		                {{Form::text('name',null,array('class' => 'form-control', 'required' =>'required'))}}
		                {{ $errors->first('name', '<p class="text-danger">:message</p>' ) }}
					</div>
				</div>
		        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
					<label class="control-label col-sm-2 require">Role Description : </label>
					 <div class="col-md-6">
		             {{Form::textarea('description',null,array('class' => 'form-control', 'rows'=>'3'))}}
		              <small>(maximum length should be 600)</small>
		              {{ $errors->first('description', '<p class="text-danger">:message</p>' ) }}
					</div>
				</div>
		        @if(($roles->is_deletable)=='1')
		        <div class="form-group">
		       	  	<div class="col-md-6">
						<label class="control-label col-sm-4">Status :</label>
					 	<div class="col-md-6">
		                	{{Form::select('status',config('myconfig.status'),null,array('class' => 'form-control'))}}
						</div>
		          	</div>
				</div>
		        @else
		        	{{Form::hidden('status','active')}}
		        @endif
		        <div class="form-group">
                    <label for="righticon" class="col-sm-2 control-label">&nbsp;</label>
                    <div class="col-sm-5">
                        <div class="checkbox-custom checkbox-success">
                            <input type="checkbox" id="checkboxCustom3" @if ($roles->can_apply) checked @endif name="can_apply" value="1">
                            <label for="checkboxCustom3" class="check">Can Apply ?</label>
                        </div>
                    </div>
                </div>
			</div>

			<div class="panel-header">
				<h4 class="panel-title">Permission Setting:</h4>
			</div>
			<label style="border:1px solid #ddd; padding:5px; margin-top: 10px; background-color: #efefef">
				<input id="checkoruncheck" type="checkbox" checked="checked">
				<strong>Check/Uncheck All</strong>
			</label>
			@php
			 	$controllersArray = array_chunk($permissions, 4, true);
			@endphp
			@foreach ($controllersArray as $elements)
				<div class="row">
					@foreach ($elements as $parent)
						<div class="col-md-3">
							<div class="checkbox controller">
							    <label>
							    	<input name="permissions[]" class="parent_{{ $parent['name'] }}" type="checkbox" <?php echo in_array($parent['id'], $checkPermissions) ? "checked='true'" : ""; ?> value="{{ $parent['id']}}" onChange="permission_select_deselect_child(this)"> <strong>{{ $parent['name'] }} </strong>
							    </label>
							</div>
							<div class="action-wraper">
								@foreach ($parent['children'] as $child)
								  <div class="checkbox actions" style="margin-left:20px;">
								    <label><input name="permissions[]" class="{{ $parent['name'] }}" type="checkbox" <?php echo in_array($child['id'], $checkPermissions) ? "checked='true'" : ""; ?> value="{{ $child['id'] }}" onChange="permission_select_parent('{{ $parent['name'] }}')"> {{ mystudy_case(snake_case($child['name'])) }}</label>
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
	                    Update Role
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
