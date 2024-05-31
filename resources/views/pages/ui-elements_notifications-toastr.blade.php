@extends('layouts.admin')
@section('content')
<!-- ========================================================= -->
<div class="content-header">
<!-- leftside content header -->
<div class="leftside-content-header">
    <ul class="breadcrumbs">
        <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">UI Elements</a></li>
        <li><a>Notifications</a></li>
        <li><a>toastr</a></li>
    </ul>
</div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<div class="row animated fadeInUp">
<div class="row">
    <div class="col-sm-12">
        <h4 class="section-subtitle text-center"><b>PNotify</b> - Is a Javascript library for non-blocking notifications.</h4>
        <p class="section-text text-center">Simple core library that can be customized and extended. For more <a href="https://github.com/CodeSeven/toastr">Info</a></p>
    </div>
</div>
<div class="col-sm-12">
    <h4 class="section-subtitle">Notification <b>Settings</b></h4>
    <div class="panel">
        <div class="panel-content">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <h5 class="mt-lg"><b>Title</b></h5>
                        <input type="text" class="form-control" id="title" placeholder="Enter a title ...">
                    </div>
                    <div class="form-group">
                        <h5 class="mt-lg"><b>Message</b></h5>
                        <textarea class="form-control" id="message" rows="4" placeholder="Enter a message ..."></textarea>
                    </div>
                    <h5 class="mt-lg"><b>Features</b></h5>
                    <div class="form-group">
                        <div class="checkbox-custom checkbox-primary">
                            <input type="checkbox" id="closeButton" value="checked">
                            <label class="check" for="closeButton">Close button</label>
                        </div>
                        <div class="checkbox-custom checkbox-primary">
                            <input type="checkbox" id="addBehaviorOnToastClick" value="checked">
                            <label class="check" for="addBehaviorOnToastClick">Add behavior on toast click</label>
                        </div>
                        <div class="checkbox-custom checkbox-primary">
                            <input type="checkbox" id="addBehaviorOnToastCloseClick" value="checked">
                            <label class="check" for="addBehaviorOnToastCloseClick">Add behavior on toast close button click</label>
                        </div>
                        <div class="checkbox-custom checkbox-primary">
                            <input type="checkbox" id="debugInfo" value="checked">
                            <label class="check" for="debugInfo">Debug on console</label>
                        </div>
                        <div class="checkbox-custom checkbox-primary">
                            <input type="checkbox" id="progressBar" value="checked" checked>
                            <label class="check" for="progressBar">Progress Bar</label>
                        </div>
                        <div class="checkbox-custom checkbox-primary">
                            <input type="checkbox" id="rtl" value="checked">
                            <label class="check" for="rtl">Right-To-Left</label>
                        </div>
                        <div class="checkbox-custom checkbox-primary">
                            <input type="checkbox" id="addClear" value="checked">
                            <label class="check" for="addClear">Add button to force clearing a toast, ignoring focus</label>
                        </div>
                        <div class="checkbox-custom checkbox-primary">
                            <input type="checkbox" id="newestOnTop" value="checked">
                            <label class="check" for="newestOnTop">Newest on top</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-2">
                    <div class="form-group" id="toastTypeGroup">
                        <h5 class="mt-lg"><b>Type</b></h5>
                        <div class="radio radio-custom radio-success pt-sm">
                            <input type="radio" id="type-success" name="toasts" value="success" checked />
                            <label for="type-success">Success</label>
                        </div>
                        <div class="radio radio-custom radio-warning pt-sm">
                            <input type="radio" id="type-warning" name="toasts" value="warning" />
                            <label for="type-warning">Warning</label>
                        </div>
                        <div class="radio radio-custom radio-danger pt-sm">
                            <input type="radio" id="type-danger" name="toasts" value="error" />
                            <label for="type-danger">Error</label>
                        </div>
                        <div class="radio radio-custom radio-info pt-sm">
                            <input type="radio" id="type-info" name="toasts" value="info" />
                            <label for="type-info">Info</label>
                        </div>
                    </div>
                    <div class="form-group" id="positionGroup">
                        <h5 class="mt-lg"><b>Position</b></h5>
                        <div class="radio radio-custom radio-primary pt-sm">
                            <input type="radio" id="position-top-right" name="positions" value="toast-top-right" checked />
                            <label for="position-top-right">Top Righ</label>
                        </div>
                        <div class="radio radio-custom radio-primary pt-sm">
                            <input type="radio" id="position-top-left" name="positions" value="toast-top-left" />
                            <label for="position-top-left">Top Left</label>
                        </div>
                        <div class="radio radio-custom radio-primary pt-sm">
                            <input type="radio" id="position-top-center" name="positions" value="toast-top-center" />
                            <label for="position-top-center">Top Center</label>
                        </div>
                        <div class="radio radio-custom radio-primary pt-sm">
                            <input type="radio" id="position-bottom-right" name="positions" value="toast-bottom-right" />
                            <label for="position-bottom-right">Bottom Right</label>
                        </div>
                        <div class="radio radio-custom radio-primary pt-sm">
                            <input type="radio" id="position-bottom-left" name="positions" value="toast-bottom-left" />
                            <label for="position-bottom-left">Bottom Left</label>
                        </div>
                        <div class="radio radio-custom radio-primary pt-sm">
                            <input type="radio" id="position-bottom-center" name="positions" value="toast-bottom-center" />
                            <label for="position-bottom-center">Bottom Center</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-2">
                    <h5 class="mv-lg"><b>Animation</b></h5>
                    <div class="form-group">
                        <label for="showEasing">Show Easing</label>
                        <select id="showEasing" class="form-control" >
                            <option value="swing" selected>swing</option>
                            <option value="linear" >linear</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="hideEasing">Hide Easing</label>
                        <select id="hideEasing" class="form-control" >
                            <option value="swing">swing</option>
                            <option value="linear" selected>linear</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="showMethod">Show Method</label>
                        <select id="showMethod" class="form-control" >
                            <option value="show">show</option>
                            <option value="fadeIn" selected>fadeIn</option>
                            <option value="slideDown" >slideDown</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="hideMethod">Hide Method</label>
                        <select id="hideMethod" class="form-control" >
                            <option value="hide">hide</option>
                            <option value="fadeOut" selected>fadeOut</option>
                            <option value="slideUp" >slideUp</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 col-md-2">
                    <h5 class="mv-lg"><b>Times</b></h5>
                    <div class="form-group">
                        <label for="showDuration">Show Duration</label>
                        <input id="showDuration" type="number" placeholder="ms" class="form-control input-mini" value="300" />
                    </div>
                    <div class="form-group">
                        <label for="hideDuration">Hide Duration</label>
                        <input id="hideDuration" type="number" placeholder="ms" class="form-control input-mini" value="500" />
                    </div>
                    <div class="form-group">
                        <label for="timeOut">Time out</label>
                        <input id="timeOut" type="number" placeholder="ms" class="form-control input-mini" value="5000" />
                    </div>
                    <div class="form-group">
                        <label for="extendedTimeOut">Extended time out</label>
                        <input id="extendedTimeOut" type="number" placeholder="ms" class="form-control input-mini" value="1000" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group mt-xl">
                        <button type="button" class="btn btn-primary" id="showtoast">Show Toast</button>
                        <button type="button" class="btn btn-danger" id="cleartoasts">Clear Toasts</button>
                        <button type="button" class="btn btn-danger" id="clearlasttoast">Clear Last Toast</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-12">
    <h4 class="section-subtitle">toastr <b>Options</b></h4>
    <div class="panel">
        <div class="panel-content">
            <pre id='toastrOptions'></pre>
        </div>
    </div>
</div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
@endsection
@section('script')
    <!--Examples-->
    <script src="{{ asset('js/examples/ui-elements/notifications-toastr.js') }}"></script>
@stop
