@extends('layouts.admin')
@section('content')
<!-- ========================================================= -->
<div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-columns" aria-hidden="true"></i><a href="#">Forms</a></li>
            <li><a>Validation</a></li>
        </ul>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<div class="row animated fadeInUp">
    <div class="col-sm-12 col-md-12 ">
        <h4 class="section-subtitle"><b>Validation states</b></h4>
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel-content">
                            <div class="form-group has-success">
                                <label for="state-success" class="control-label">Success</label>
                                <input type="text" class="form-control" id="state-success">
                            </div>
                            <div class="form-group has-warning">
                                <label for="state-warning" class="control-label">Warning</label>
                                <input type="text" class="form-control" id="state-warning">
                            </div>
                            <div class="form-group has-error">
                                <label for="state-error" class="control-label">Error</label>
                                <input type="text" class="form-control" id="state-error">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel-content">
                            <div class="form-group  has-success has-feedback">
                                <label for="state-success-feedback" class="control-label">Success</label>
                                <input type="text" class="form-control" id="state-success-feedback">
                                <span class="glyphicon glyphicon-ok form-control-feedback"></span>
                            </div>
                            <div class="form-group has-warning has-feedback">
                                <label for="state-warning-feedback" class="control-label">Warning</label>
                                <input type="text" class="form-control" id="state-warning-feedback">
                                <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
                            </div>
                            <div class="form-group has-error has-feedback">
                                <label for="state-error-feedback" class="control-label">Error</label>
                                <input type="text" class="form-control" id="state-error-feedback">
                                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-8 col-md-offset-2">
        <h4 class="section-subtitle"><b>Inline validation</b></h4>
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <div class="col-md-12">
                        <form id="inline-validation" class="form-horizontal form-stripe">
                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">Name<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username" class="col-sm-3 control-label">Username<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="username" name="username" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-3 control-label">Email<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-3 control-label">Password<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cofirmation" class="col-sm-3 control-label">Confirmation<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="cofirmation" name="confirmation" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="age" class="col-sm-3 control-label">Age<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="age" name="age" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="url" class="col-sm-3 control-label">Url</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="url" name="url">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-8 col-md-offset-2">
        <h4 class="section-subtitle"><b>Message box validation</b></h4>
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <div class="col-md-12">
                        <form id="messagebox-validation"  class="">
                            <div class="message-container alert alert-danger">
                                <ul></ul>
                            </div>
                            <div class="form-group">
                                <label for="username2" class=" control-label">Username<span class="required">*</span></label>
                                <input type="text" class="form-control" id="username2" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="email2" class=" control-label">Email<span class="required">*</span></label>
                                <input type="email" class="form-control" id="email2" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password2" class=" control-label">Password<span class="required">*</span></label>
                                <input type="password" class="form-control" id="password2" name="password" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
@endsection
@section('script')
    <script src="{{ asset('vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/examples/forms/validation.js') }}"></script>
@stop
