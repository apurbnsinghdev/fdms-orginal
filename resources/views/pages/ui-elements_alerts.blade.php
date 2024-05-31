@extends('layouts.admin')
@section('content')
<!-- ========================================================= -->
<div class="content-header">
<!-- leftside content header -->
<div class="leftside-content-header">
    <ul class="breadcrumbs">
        <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">UI Elements</a></li>
        <li><a>Alerts</a></li>
    </ul>
</div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<div class="row animated fadeInUp">
<!--SWEETALERT-->
<div class="col-sm-8 col-sm-offset-2">
    <h4 class="section-subtitle text-center"><b>SweetAlert</b> -  A beautiful replacement for JavaScript's "Alert"</h4>
    <p class="section-text text-center mt-sm"> In these examples, we're using the shorthand function swal to call sweetAlert. For more <a href="http://t4t5.github.io/sweetalert/">Info</a></p>

</div>
<div class="col-sm-12 mt-md">
    <div class="panel">
        <div class="panel-content text-center">
            <div class="row">
                <div class="col-md-4">
                    <h5><b>Basic message</b></h5>
                    <td><button type="button" id="basic-alert" class="btn btn-wide btn-primary">Click me!</button></td>
                </div>
                <div class="col-md-4">
                    <h5><b>Title with a text under</b></h5>
                    <td><button type="button" id="title-text-alert" class="btn btn-wide btn-lighter-1">Click me!</button></td>
                </div>
                <div class="col-md-4">
                    <h5><b>Success message</b></h5>
                    <td><button type="button" id="success-alert" class="btn btn-wide btn-primary">Click me!</button></td>
                </div>
            </div>
            <div class="row mt-md">
                <div class="col-md-4">
                    <h5><b>Warning message with confirmation</b></h5>
                    <td><button type="button" id="warning-alert" class="btn btn-wide btn-lighter-1">Click me!</button></td>
                </div>
                <div class="col-md-4">
                    <h5><b>Message with auto close timer</b></h5>
                    <td><button type="button" id="timer-alert" class="btn btn-wide btn-primary">Click me!</button></td>
                </div>
                <div class="col-md-4">
                    <h5><b>Replacement for the "prompt" function</b></h5>
                    <td><button type="button" id="prompt-alert" class="btn btn-wide btn-lighter-1">Click me!</button></td>
                </div>
            </div>
        </div>
    </div>
</div>
<!--TOOLTIPS-->
<div class="col-sm-12">
    <h4 class="section-subtitle"><b>Tooltips</b></h4>
    <div class="panel">
        <div class="panel-content">
            <div class="row">
                <!--BUTTONS tooltips-->
                <div class="col-md-12">
                    <p>Add the properties <span class="code">data-toggle="tooltip"</span>, <span class="code">data-placement="[positon]"</span> and <span class="code">title="[message]"</span> </p>
                    <h5 class="mt-md"><b>Buttons</b> tooltips</h5>
                    <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="left" title="Tooltip on left">Tooltip on left</button>
                    <button type="button" class="btn btn-lighter-1" data-toggle="tooltip" data-placement="top" title="Tooltip on top">Tooltip on top</button>
                    <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom">Tooltip on bottom</button>
                    <button type="button" class="btn btn-lighter-1" data-toggle="tooltip" data-placement="right" title="Tooltip on right">Tooltip on right</button>
                </div>
                <!--LINKS tooltips-->
                <div class="col-md-12 mt-md">
                    <h5><b>Links</b> tooltips</h5>
                    <a href="#" class="mr-xl color-primary" data-toggle="tooltip" data-placement="left" title="Tooltip on left">Tooltip on left</a>
                    <a href="#" class="mr-xl color-lighter-1" data-toggle="tooltip" data-placement="top" title="Tooltip on top">Tooltip on top</a>
                    <a href="#" class="mr-xl color-primary" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom">Tooltip on bottom</a>
                    <a href="#" class="mr-xl color-lighter-1" data-toggle="tooltip" data-placement="right" title="Tooltip on right">Tooltip on right</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<!--POPOVER-->
<div class="col-sm-12">
    <h4 class="section-subtitle"><b>Popover</b></h4>
    <div class="panel">
        <div class="panel-content">
            <div class="row">
                <div class="col-md-12">
                    <h5><b>Buttons</b> popover </h5>
                    <p>Add the properties <span class="code">data-toggle="popover"</span>, <span class="code">data-placement="[positon]"</span> and <span class="code">data-content="[message]"</span> </p>
                    <button type="button" class="btn btn-lighter-1" data-toggle="popover" data-placement="left" data-content="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt, repellat.">
                        Popover on left
                    </button>
                    <button type="button" class="btn btn-primary" data-toggle="popover" data-placement="top" data-content="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt, repellat.">
                        Popover on top
                    </button>
                    <button type="button" class="btn btn-lighter-1" data-toggle="popover" data-placement="bottom" data-content="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt, repellat.">
                        Popover on bottom
                    </button>
                    <button type="button" class="btn btn-primary" data-toggle="popover" data-placement="right" data-content="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt, repellat.">
                        Popover on right
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<!--ALERTS-->
<div class="col-sm-12">
    <h4 class="section-subtitle"><b>Alerts</b></h4>
    <div class="panel">
        <div class="panel-content">
            <div class="row">
                <div class="col-md-12">
                    <p>Add the classes <span class="code">.alert</span> and <span class="code">.alert-[state]"</span> </p>
                    <!--SUCCESS-->
                    <div class="alert alert-success fade in">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>Success!</strong> Good everything went well!
                    </div>
                    <!--WARNING-->
                    <div class="alert alert-warning fade in">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>Warning!</strong> Better check again!
                    </div>
                    <!--DANGER-->
                    <div class="alert alert-danger fade in">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>Danger!</strong> A problem has occurred!
                    </div>
                    <!--INFO-->
                    <div class="alert alert-info fade in">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>Note!</strong> Please read this message!
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
@endsection
@section('script')
    <!--seewtaler-->
    <script src="{{ asset('vendor/sweetalert/sweetalert.min.js') }}"></script>
    <!--Examples-->
    <script src="{{ asset('js/examples/ui-elements/alerts.js') }}"></script>
@stop
@section('css')
    <!--seewtaler-->
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert/sweetalert.css') }}">
@stop
