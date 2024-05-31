@extends('layouts.admin')
@section('content')
<div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-columns" aria-hidden="true"></i><a href="#">Forms</a></li>
            <li><a>Elements</a></li>
        </ul>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<div class="row animated fadeInUp">
    <!--SETTINGS-->
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Settings</b></h4>
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-horizontal form-stripe">
                            <!--PLACEHOLDER-->
                            <div class="form-group">
                                <label for="placeholder" class="col-sm-2 control-label">Placeholder</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="placeholder" placeholder="Placeholder">
                                </div>
                            </div>
                            <!--DISABLE-->
                            <div class="form-group">
                                <label for="disabled" class="col-sm-2 control-label">Disabled</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="disabled" placeholder="Disabled input" disabled="disabled">
                                </div>
                            </div>
                            <!--READ ONLY-->
                            <div class="form-group">
                                <label for="readonly" class="col-sm-2 control-label">Read only</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="readonly" value="Read only content" readonly="readonly">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--HELPERS-->
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Helpers</b></h4>
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-horizontal form-stripe">
                            <!--TOOLTIPS-->
                            <div class="form-group">
                                <label for="tooltip" class="col-sm-2 control-label">Tooltip</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="tooltip" placeholder="Hover me!" data-toggle="tooltip" data-trigger="hover" data-original-title="Your tooltip content!">
                                </div>
                            </div>
                            <!--POPOVER-->
                            <div class="form-group">
                                <label for="popover" class="col-sm-2 control-label">Popover</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="popover" placeholder="Click me!" data-toggle="popover" data-placement="top" data-trigger="click" data-content="Your popover content!">
                                </div>
                            </div>
                            <!--BLOCK HELP-->
                            <div class="form-group">
                                <label for="blockofhelp" class="col-sm-2 control-label">Block help</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="blockofhelp" placeholder="input with help information">
                                    <span class="help-block"><i class="fa fa-info-circle mr-xs"></i>A block of help text that breaks onto a new line and may extend beyond one line.</span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--SIZES-->
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Sizes</b></h4>
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-horizontal ">
                            <!--LARGE-->
                            <div class="form-group">
                                <label for="sizelg" class="col-sm-2 control-label">Large</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control input-lg" id="sizelg" placeholder="large input">
                                    <span class="help-block"><i class="fa fa-info-circle mr-xs"></i>Add to the input the class <span class="code">.input-lg</span></span>
                                </div>
                            </div>
                            <!--MEDIUM-->
                            <div class="form-group">
                                <label for="sizemd" class="col-sm-2 control-label">Medium</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="sizemd" placeholder="default input">
                                    <span class="help-block"><i class="fa fa-info-circle mr-xs"></i>Default input size</span>
                                </div>
                            </div>
                            <!--SMALL-->
                            <div class="form-group">
                                <label for="sizesm" class="col-sm-2 control-label">Small</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control input-sm" id="sizesm" placeholder="small input">
                                    <span class="help-block"><i class="fa fa-info-circle mr-xs"></i>Add to the input the class <span class="code">.input-sm</span></span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--ICONS-->
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Icons</b></h4>
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-horizontal">
                            <!--LEFT icon-->
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Left icon</label>
                                <div class="col-sm-10">
                                        <span class="input-with-icon">
                                        <input type="text" class="form-control" id="lefticon" placeholder="Left side icon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </div>
                            </div>
                            <!--RIGHT icon-->
                            <div class="form-group">
                                <label for="righticon" class="col-sm-2 control-label">Right icon</label>
                                <div class="col-sm-10">
                                        <span class="input-with-icon right-icon-input">
                                        <input type="text" class="form-control" id="righticon" placeholder="Right side icon">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--ADDS ON-->
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Groups Adds on </b></h4>
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-horizontal form-stripe">
                            <!--ICONS adds on-->
                            <div class="form-group">
                                <label for="left-addon-icon" class="col-sm-2 control-label">Icons</label>
                                <div class="col-sm-10">
                                    <div class="input-group mb-sm">
                                        <span class="input-group-addon">@</span>
                                        <input type="text" class="form-control" id="left-addon-icon" placeholder="Username">
                                    </div>
                                    <div class="input-group mb-sm">
                                        <input type="text" class="form-control" id="right-addon-icon">
                                        <span class="input-group-addon">.00</span>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon">Total</span>
                                        <input type="text" class="form-control" id="leftright-addon-icon">
                                        <span class="input-group-addon">.00</span>
                                    </div>
                                </div>
                            </div>
                            <!--BUTTONS adds on-->
                            <div class="form-group">
                                <label for="righticon" class="col-sm-2 control-label">Buttons</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="button-addon" placeholder="comment">
                                            <span class="input-group-btn">
                                                <button class="btn btn-primary" type="button">Send</button>
                                       </span>
                                    </div>
                                </div>
                            </div>
                            <!--CHECK & RADIO adds on-->
                            <div class="form-group">
                                <label for="righticon" class="col-sm-2 control-label">Checkbox & radio</label>
                                <div class="col-sm-10">
                                    <div class="input-group mb-sm">
                                            <span class="input-group-addon">
                                                <input type="checkbox" checked>
                                            </span>
                                        <input type="text" class="form-control" id="checkbox-addon" placeholder="other option">
                                    </div>
                                    <div class="input-group">
                                            <span class="input-group-addon">
                                                <input type="radio" checked>
                                            </span>
                                        <input type="text" class="form-control" id="radio-addon" placeholder="other option">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--CHECKBOX & RADIO-->
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Checkbox</b></h4>
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-horizontal form-stripe">
                            <!--DEFAULT checkbox & radio-->
                            <div class="form-group">
                                <label for="left-addon-icon" class="col-sm-2 control-label">Default</label>
                                <div class="col-sm-5">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="checkbox1" value="option1" checked> Checkbox option 1
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="checkbox2" value="option2"> Checkbox option 2
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="checkbox3" value="option2"> Checkbox option 3
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="optionsRadios" id="radio1" value="option1" checked> Radio option 1
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="optionsRadios" id="radio2" value="option2"> Radio option 2
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="optionsRadios" id="radio3" value="option3"> Radio option 3
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!--INLINE checkbox & radio-->
                            <div class="form-group">
                                <label for="righticon" class="col-sm-2 control-label">Inline</label>
                                <div class="col-sm-5">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" id="inlineCheckbox1" value="option1" checked> Checkbox 1
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" id="inlineCheckbox2" value="option2"> Checkbox 2
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" id="inlineCheckbox3" value="option3"> Checkbox 3
                                    </label>
                                </div>
                                <div class="col-sm-5">
                                    <label class="radio-inline">
                                        <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked> Radio 1
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> Radio 2
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3"> Radio 3
                                    </label>
                                </div>
                            </div>
                            <!--CUSTOM checkbox & radio-->
                            <div class="form-group">
                                <label for="righticon" class="col-sm-2 control-label">Custom</label>
                                <div class="col-sm-5">
                                    <div class="checkbox-custom checkbox-success">
                                        <input type="checkbox" id="checkboxCustom3" value="option1" checked>
                                        <label class="check" for="checkboxCustom3">Checkbox success</label>
                                    </div>
                                    <div class="checkbox-custom checkbox-warning">
                                        <input type="checkbox" id="checkboxCustom4" value="option1" checked>
                                        <label class="check" for="checkboxCustom4">Checkbox warning</label>
                                    </div>
                                    <div class="checkbox-custom checkbox-danger">
                                        <input type="checkbox" id="checkboxCustom5" value="option1" checked>
                                        <label class="check" for="checkboxCustom5">Checkbox danger</label>
                                    </div>
                                    <div class="checkbox-custom checkbox-info">
                                        <input type="checkbox" id="checkboxCustom6" value="option1" checked>
                                        <label class="check" for="checkboxCustom6">Checkbox info</label>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="radio radio-custom radio-success">
                                        <input type="radio" id="radioCustom3" name="CustomOptionsRadios" value="option3" checked>
                                        <label for="radioCustom3">Radio success</label>
                                    </div>
                                    <div class="radio radio-custom radio-warning">
                                        <input type="radio" id="radioCustom4" name="CustomOptionsRadios" value="option4">
                                        <label for="radioCustom4">Radio warning</label>
                                    </div>
                                    <div class="radio radio-custom radio-danger">
                                        <input type="radio" id="radioCustom5" name="CustomOptionsRadios" value="option5">
                                        <label for="radioCustom5">Radio danger</label>
                                    </div>
                                    <div class="radio radio-custom radio-info">
                                        <input type="radio" id="radioCustom6" name="CustomOptionsRadios" value="option6">
                                        <label for="radioCustom6">Radio info</label>
                                    </div>
                                </div>
                            </div>
                            <!--CUSTOM INLINE checkbox & radio-->
                            <div class="form-group">
                                <label for="righticon" class="col-sm-2 control-label">Custom Inline</label>
                                <div class="col-sm-5">
                                    <div class="checkbox-custom checkbox-inline">
                                        <input type="checkbox" id="checkboxCustom1" value="option1" checked>
                                        <label class="check" for="checkboxCustom1">Checkbox default</label>
                                    </div>
                                    <div class="checkbox-custom checkbox-inline checkbox-primary">
                                        <input type="checkbox" id="checkboxCustom2" value="option1" checked>
                                        <label class="check" for="checkboxCustom2">Checkbox primary</label>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="radio radio-custom radio-inline">
                                        <input type="radio" id="radioCustom1" name="CustomInlineOptionsRadios" value="option1" checked>
                                        <label for="radioCustom1">Radio default</label>
                                    </div>
                                    <div class="radio radio-custom radio-inline radio-primary">
                                        <input type="radio" id="radioCustom2" name="CustomInlineOptionsRadios" value="option2">
                                        <label for="radioCustom2">Radio primary</label>
                                    </div>
                                </div>
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