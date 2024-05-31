@extends('layouts.admin')
@section('content')
<!-- ========================================================= -->
<div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-columns" aria-hidden="true"></i><a href="#">Forms</a></li>
            <li><a>Wizard</a></li>
        </ul>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<div class="animated fadeInUp">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <h4 class="section-subtitle text-center"><b>Twitter Bootstrap Wizard</b></h4>
            <p class="section-text text-center">  It allows to build a wizard functionality using buttons to go through the different wizard steps and using events allows to hook into each step individually. For more <a href="http://vinceg.github.io/twitter-bootstrap-wizard/">Info</a></p>
        </div>
        <div class="col-sm-12">
            <div class="panel">
                <div class="panel-content">
                    <div class="alert alert-warning m-none">
                        <i class="fa fa-exclamation-circle mr-sm text-md"></i> Re-size your browser window to see the different style of responsive. NORMAL, LIST or HORIZONTAL SCROLL
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!--BASIC-->
        <div class="col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-0">
            <h4 class="section-subtitle"><b>Basic</b> wizard <small>(Validation <b>enabled</b>)</small></h4>
            <div class="panel">
                <div class="panel-content">
                    <div class="form-wizard wizard-basic ">
                        <form  id="wizard-1">
                            <div class="tab-steps">
                                <ul>
                                    <li class="active"><a href="#w1-tab1" data-toggle="tab"><span class="tab-number">1</span>First</a></li>
                                    <li><a href="#w1-tab2" data-toggle="tab"><span class="tab-number">2</span>Second</a></li>
                                    <li><a href="#w1-tab3" data-toggle="tab"><span class="tab-number">3</span>Third</a></li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane active" id="w1-tab1">

                                    <div class="form-group">
                                        <label for="w1-username" class="control-label">Username<span class="required">*</span></label>
                                        <input type="text" class="form-control" id="w1-username" name="username" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="w1-password" class="control-label">Password<span class="required">*</span></label>
                                        <input type="password" class="form-control" id="w1-password" name="password" required>
                                    </div>
                                </div>
                                <div class="tab-pane" id="w1-tab2">
                                    <div class="form-group">
                                        <label for="w1-name" class="control-label">Name<span class="required">*</span></label>
                                        <input type="text" class="form-control" id="w1-name" name="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="w1-email" class="control-label">Email<span class="required">*</span></label>
                                        <input type="email" class="form-control" id="w1-email" name="email" required>
                                    </div>
                                </div>
                                <div class="tab-pane" id="w1-tab3">

                                    <div class="form-group">
                                        <label for="w1-age" class="control-label" class="col-sm-3 control-label">Age<span class="required">*</span></label>
                                        <input type="text" class="form-control" id="w1-age" name="age" required>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox-custom checkbox-primary">
                                            <input type="checkbox" id="w1-terms" name="terms" value="option1">
                                            <label class="check" for="w1-terms">I agree </label>  to the <a href="#">Terms and Conditions</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-buttons">
                                <a class="btn btn-primary previous">Previous</a>
                                <button class="btn btn-primary finish hidden">Submit</button>
                                <a class="btn btn-primary next">Next</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!--BASIC BLOCK-->
        <div class="col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-0">
            <h4 class="section-subtitle"><b>Basic Block</b> wizard <small>(Validation disabled)</small></h4>
            <div class="panel">
                <div class="panel-content">
                    <div class="form-wizard wizard-basic wizard-block wizard-list-tabs">
                        <form  id="wizard-2">
                            <div class="tab-steps">
                                <ul>
                                    <li class="active"><a href="#w2-tab1" data-toggle="tab">Account</a></li>
                                    <li><a href="#w2-tab2" data-toggle="tab">Personal Info</a></li>
                                    <li><a href="#w2-tab3" data-toggle="tab">Terms & conditions</a></li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane active" id="w2-tab1">

                                    <div class="form-group">
                                        <label for="w2-username" class="control-label">Username<span class="required">*</span></label>
                                        <input type="text" class="form-control" id="w2-username" name="username" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="w2-password" class="control-label">Password<span class="required">*</span></label>
                                        <input type="password" class="form-control" id="w2-password" name="password" required>
                                    </div>
                                </div>
                                <div class="tab-pane" id="w2-tab2">
                                    <div class="form-group">
                                        <label for="w2-name" class="control-label">Name<span class="required">*</span></label>
                                        <input type="text" class="form-control" id="w2-name" name="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="w2-email" class="control-label">Email<span class="required">*</span></label>
                                        <input type="email" class="form-control" id="w2-email" name="email" required>
                                    </div>
                                </div>
                                <div class="tab-pane" id="w2-tab3">

                                    <div class="form-group">
                                        <label for="w2-age" class="control-label" class="col-sm-3 control-label">Age<span class="required">*</span></label>
                                        <input type="text" class="form-control" id="w2-age" name="age" required>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox-custom checkbox-primary">
                                            <input type="checkbox" id="w2-terms" name="terms" value="option1">
                                            <label class="check" for="w2-terms">I agree </label>  to the <a href="#">Terms and Conditions</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-buttons">
                                <a class="btn btn-primary previous">Previous</a>
                                <button class="btn btn-primary finish hidden">Submit</button>
                                <a class="btn btn-primary next">Next</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!--ARROW WIZARD-->
        <div class="col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-0">
            <h4 class="section-subtitle"><b>Arrows</b> wizard <small>(Validation disabled)</small></h4>
            <div class="panel">
                <div class="panel-content">
                    <div class="form-wizard wizard-arrows">
                        <form  id="wizard-3">
                            <div class="tab-steps">
                                <ul>
                                    <li class="active"><a href="#w3-tab1" data-toggle="tab">Account</a></li>
                                    <li><a href="#w3-tab2" data-toggle="tab">Personal Info</a></li>
                                    <li><a href="#w3-tab3" data-toggle="tab">Terms & conditions</a></li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane active" id="w3-tab1">

                                    <div class="form-group">
                                        <label for="w3-username" class="control-label">Username<span class="required">*</span></label>
                                        <input type="text" class="form-control" id="w3-username" name="username" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="w3-password" class="control-label">Password<span class="required">*</span></label>
                                        <input type="password" class="form-control" id="w3-password" name="password" required>
                                    </div>
                                </div>
                                <div class="tab-pane" id="w3-tab2">
                                    <div class="form-group">
                                        <label for="w3-name" class="control-label">Name<span class="required">*</span></label>
                                        <input type="text" class="form-control" id="w3-name" name="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="w3-email" class="control-label">Email<span class="required">*</span></label>
                                        <input type="email" class="form-control" id="w3-email" name="email" required>
                                    </div>
                                </div>
                                <div class="tab-pane" id="w3-tab3">

                                    <div class="form-group">
                                        <label for="w3-age" class="control-label" class="col-sm-3 control-label">Age<span class="required">*</span></label>
                                        <input type="text" class="form-control" id="w3-age" name="age" required>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox-custom checkbox-primary">
                                            <input type="checkbox" id="w3-terms" name="terms" value="option1">
                                            <label class="check" for="w3-terms">I agree </label>  to the <a href="#">Terms and Conditions</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-buttons">
                                <a class="btn btn-primary previous">Previous</a>
                                <button class="btn btn-primary finish hidden">Submit</button>
                                <a class="btn btn-primary next">Next</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <!--ARROW BLOCK WIZARD-->
        <div class="col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-0">
            <h4 class="section-subtitle"><b>Arrows Block</b> wizard <small>(Validation disabled)</small></h4>
            <div class="panel">
                <div class="panel-content">
                    <div class="form-wizard wizard-block wizard-arrows">
                        <form  id="wizard-4">
                            <div class="tab-steps">
                                <ul>
                                    <li class="active"><a href="#w4-tab1" data-toggle="tab"><span class="tab-number">1</span>First</a></li>
                                    <li><a href="#w4-tab2" data-toggle="tab"><span class="tab-number">2</span>Second</a></li>
                                    <li><a href="#w4-tab3" data-toggle="tab"><span class="tab-number">3</span>Third</a></li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane active" id="w4-tab1">

                                    <div class="form-group">
                                        <label for="w4-username" class="control-label">Username<span class="required">*</span></label>
                                        <input type="text" class="form-control" id="w4-username" name="username" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="w4-password" class="control-label">Password<span class="required">*</span></label>
                                        <input type="password" class="form-control" id="w4-password" name="password" required>
                                    </div>
                                </div>
                                <div class="tab-pane" id="w4-tab2">
                                    <div class="form-group">
                                        <label for="w4-name" class="control-label">Name<span class="required">*</span></label>
                                        <input type="text" class="form-control" id="w4-name" name="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="w4-email" class="control-label">Email<span class="required">*</span></label>
                                        <input type="email" class="form-control" id="w4-email" name="email" required>
                                    </div>
                                </div>
                                <div class="tab-pane" id="w4-tab3">

                                    <div class="form-group">
                                        <label for="w4-age" class="control-label" class="col-sm-3 control-label">Age<span class="required">*</span></label>
                                        <input type="text" class="form-control" id="w4-age" name="age" required>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox-custom checkbox-primary">
                                            <input type="checkbox" id="w4-terms" name="terms" value="option1">
                                            <label class="check" for="w4-terms">I agree </label>  to the <a href="#">Terms and Conditions</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-buttons">
                                <a class="btn btn-primary previous">Previous</a>
                                <button class="btn btn-primary finish hidden">Submit</button>
                                <a class="btn btn-primary next">Next</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!--ICON WIZARD-->
        <div class="col-md-8 col-md-offset-2">
            <h4 class="section-subtitle"><b>Icons</b> wizard <small>(Validation disabled)</small></h4>
            <div class="panel">
                <div class="panel-content">
                    <div class="form-wizard wizard-block wizard-icons">
                        <form  id="wizard-5">
                            <div class="tab-steps">
                                <ul>
                                    <li class="active"><a href="#w5-tab1" data-toggle="tab">
                                        <span class="tab-icon"> <i class="fa fa-user"></i></span>
                                        <span class="tab-text">Account</span>
                                    </a></li>
                                    <li><a href="#w5-tab2" data-toggle="tab">
                                        <span class="tab-icon"><i class="fa fa-info"></i></span>
                                        <span class="tab-text">Personal Info</span>
                                    </a></li>
                                    <li><a href="#w5-tab3" data-toggle="tab">
                                        <span class="tab-icon"><i class="fa fa-check"></i></span>
                                        <span class="tab-text">Terms & conditions</span>
                                    </a></li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane active" id="w5-tab1">

                                    <div class="form-group">
                                        <label for="w5-username" class="control-label">Username<span class="required">*</span></label>
                                        <input type="text" class="form-control" id="w5-username" name="username" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="w5-password" class="control-label">Password<span class="required">*</span></label>
                                        <input type="password" class="form-control" id="w5-password" name="password" required>
                                    </div>
                                </div>
                                <div class="tab-pane" id="w5-tab2">
                                    <div class="form-group">
                                        <label for="w5-name" class="control-label">Name<span class="required">*</span></label>
                                        <input type="text" class="form-control" id="w5-name" name="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="w5-email" class="control-label">Email<span class="required">*</span></label>
                                        <input type="email" class="form-control" id="w5-email" name="email" required>
                                    </div>
                                </div>
                                <div class="tab-pane" id="w5-tab3">

                                    <div class="form-group">
                                        <label for="w5-age" class="control-label" class="col-sm-3 control-label">Age<span class="required">*</span></label>
                                        <input type="text" class="form-control" id="w5-age" name="age" required>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox-custom checkbox-primary">
                                            <input type="checkbox" id="w5-terms" name="terms" value="option1">
                                            <label class="check" for="w5-terms">I agree </label>  to the <a href="#">Terms and Conditions</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-buttons">
                                <a class="btn btn-primary previous">Previous</a>
                                <button class="btn btn-primary finish hidden">Submit</button>
                                <a class="btn btn-primary next">Next</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
@endsection
@section('script')
    <script src="{{ asset('vendor/twitter-bootstrap-wizard/jquery.bootstrap.wizard.js') }}"></script>
    <script src="{{ asset('vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/examples/forms/wizard.js') }}"></script>
@stop
