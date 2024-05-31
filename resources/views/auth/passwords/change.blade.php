@extends('layouts.admin',['className' => 'fixed accounts forgot-password'])

@section('content')
<div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Passward</a></li>
            <li><a>Change</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Password Change</b></h4>
        <span class="pull-right">
        </span>
         <div class="panel">
            <div class="panel-content">
                {!! Form::model(request()->old(),array('route' => array('password.change'),'method' => 'PUT','class'=>'form-horizontal')) !!}
                    <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
                        <label for="current_password" class="col-md-4 control-label">Current Password</label>

                        <div class="col-md-6">
                            <input id="current_password" type="password" class="form-control" name="current_password" required>

                            @if ($errors->has('current_password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('current_password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
                        <label for="new_password" class="col-md-4 control-label">New Password</label>

                        <div class="col-md-6">
                            <input id="new_password" type="password" class="form-control" name="new_password" required>

                            @if ($errors->has('new_password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('new_password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('new_password_confirmation') ? ' has-error' : '' }}">
                        <label for="password-confirm" class="col-md-4 control-label">Confirm New Password</label>
                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="new_password_confirmation" required>

                            @if ($errors->has('new_password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('new_password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Change Password
                            </button>
                        </div>
                    </div>
                 {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection

