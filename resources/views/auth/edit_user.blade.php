@extends('layouts.admin',['className' => 'sign-in'])
@section('title', 'Register User')
@section('content')
<div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">User</a></li>
            <li><a>Edit</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>User Edit</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('users.index','<i class="fa fa-list"></i>',[],array('class'=>'btn btn-success','style'=>'margin-bottom:10px'))) !!}
        </span>
         <div class="panel">
            <div class="panel-content">
                 {!! Form::model($user,array('route' => array('users.update',$user->id),'enctype'=>'multipart/form-data','method' => 'PUT','class'=>'form-horizontal','id'=>'inline-validation')) !!}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-2 control-label require">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         <div class="form-group{{ $errors->has('role_id') ? ' has-error' : '' }}">
                            <label for="role_id" class="col-md-2 control-label require">Role</label>
                            <div class="col-md-6">
                            {{Form::select('role_id',$roles,$user->role_id,array('class' => 'form-control'))}}
                            </div>
                            @if ($errors->has('role_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('role_id') }}</strong>
                                </span>
                            @endif
                        </div>
                         <div class="form-group{{ $errors->has('designation_id') ? ' has-error' : '' }}">
                            <label for="designation_id" class="col-md-2 control-label require">Designation</label>
                            <div class="col-md-6">
                            {{Form::select('designation_id',$designations,$user->designation_id,array('class' => 'form-control'))}}
                            </div>
                             @if ($errors->has('designation_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('designation_id') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                            <label for="mobile" class="col-md-2 control-label require">Mobile Number</label>
                            <div class="col-md-6">
                            {{Form::text('mobile',$user->mobile,array('class' => 'form-control max-length','oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength'=>11,'required'=>'required'))}}
                            </div>
                             @if ($errors->has('mobile'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('mobile') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-2 control-label require">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group">
                            <label for="status" class="col-md-2 control-label require">Status</label>
                            <div class="col-md-6">
                            {{Form::select('status',config('myconfig.status'),$user->status,array('class' => 'form-control'))}}
                            </div>
                        </div>
                        <div class="panel-header mb-md bt-xsm">
                            <h4 class="panel-title">Assain to depot:</h4>
                        </div>
                        <div class="form-group">
                        	<label for="status" class="col-md-2 control-label">&nbsp;</label>
                        	<div class="col-md-8">
                                <label style="border:1px solid #ddd; padding:5px;background-color: #efefef">
                    				<input id="checkoruncheck" type="checkbox">
                    				<strong>Check/Uncheck All</strong>
                    			</label>
                			</div>
            			</div>

                        <div class="form-group">
                            <label for="status" class="col-md-2 control-label">Depot Name: </label>
                            <div class="col-md-8">
                                <div class="row">
                                    @foreach ($depots as $val)
                                    <div class="col-md-6 input-container">
                                        <label><input class="depots" name="depots[]" id="depot-{{ $val->id }}" type="checkbox" value="{{ $val->id }}" @if(in_array($val->id,$depotIds->toArray())) checked  @endif ><strong>{{ $val->name }}</strong></label>
                                        @if ($val->distributors->count())
                                        <span class="fa fa-sort-desc"></span>
                                        <ul class="distributor">
                                            @foreach ($val->distributors as $ele)
                                                 <li><label><input name="distributors[]"  data-parent="{{ $val->id }}" class="distributors depot-{{ $val->id }}" type="checkbox" value="{{ $ele->id }}" @if(in_array($ele->id,$distributorIds->toArray())) checked  @endif><strong>{!! $ele->outlet_name !!}</strong></label></li>
                                            @endforeach
                                        </ul>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-2">
                                <button type="submit" class="btn btn-primary">
                                    Update User
                                </button>
                            </div>
                        </div>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
@section('css')
<style>
    .fa-sort-desc{
        cursor: pointer;
        font-size: 20px;
    }
    .fa-sort-desc.open{
        transform: rotate(90deg);
    }
    .distributor{
        display: none;
        list-style: none;
    }

</style>
@stop
@section('script')
@include('common_pages.max_length')
<script>
$(document).on('click','.fa-sort-desc',function(){
    $(this).next('ul.distributor').slideToggle();
    $(this).toggleClass('open');
});

$(document).on('click','.depots',function(){
    var tis=$(this);
    var obj=tis.parents('.input-container').find('ul.distributor');
    if(tis.is(':checked')){
        var lgth=obj.find("input:checkbox:checked").length;
        if(!lgth){
            obj.find("input:checkbox").prop('checked',true);
        }
    }else{
        obj.find("input:checkbox").prop('checked',false);
    }
});

$(document).on('click','.distributors',function(){
    var idd=$(this).data('parent');
   if($('.depot-'+idd+':checked').length){
        $('#depot-'+idd).prop('checked',true);
   }else{
        $('#depot-'+idd).prop('checked',false);
   }
});
$(document).ready(function(e){
    $("#checkoruncheck").change(function () {
        $("input:checkbox").prop('checked', $(this).prop("checked"));
    });
});
</script>
@stop