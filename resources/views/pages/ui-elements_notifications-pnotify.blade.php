@extends('layouts.admin')
@section('content')
<!-- ========================================================= -->
<div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">UI Elements</a></li>
            <li><a>Notifications</a></li>
            <li><a>PNotify</a></li>
        </ul>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<div class="row animated fadeInUp">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="section-subtitle text-center"><b>PNotify</b> - Is a JavaScript notification system</h4>
            <p class="section-text text-center"> Provide <span class="highlight">desktop notifications</span> and works on your <span class="highlight">phone and tablet</span>. For more <a href="http://sciactive.com/pnotify/">Info</a></p>
        </div>
    </div>
    <!--BASIC-->
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Default</b> Notifications</h4>
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <!--BASIC-->
                    <div class="col-md-12">
                        <h5><b>Basic</b> notifications</h5>
                        <button id="pnotify-basic-success" class="btn btn-wide btn-success">Success</button>
                        <button id="pnotify-basic-warning" class="btn btn-wide btn-warning">Warning</button>
                        <button id="pnotify-basic-error" class="btn btn-wide btn-danger">Error</button>
                        <button id="pnotify-basic-info" class="btn btn-wide btn-info">Info</button>
                        <button id="pnotify-basic-primary" class="btn btn-wide btn-primary">Primary</button>
                        <button id="pnotify-basic-dark" class="btn btn-wide ">Dark</button>
                        <button id="pnotify-basic-light" class="btn btn-wide ">Light</button>
                    </div>
                    <!--POSITION-->
                    <div class="col-md-12 mt-lg">
                        <h5><b>Position</b> of the notice</h5>
                        <p>You can specify where the notifications will show up</p>
                        <button id="pnotify-position-topLeft" class="btn btn-wide btn-o btn-primary">Top Left</button>
                        <button id="pnotify-position-topRight" class="btn btn-wide btn-o btn-primary">Top Right</button>
                        <button id="pnotify-position-bottomRight" class="btn btn-wide btn-o btn-primary">Bottom Right</button>
                        <button id="pnotify-position-bottomLeft" class="btn btn-wide btn-o btn-primary">Bottom Left</button>
                    </div>
                    <!--STYLE-->
                    <div class="col-md-12 mt-lg">
                        <h5><b>Style</b> of the notice</h5>
                        <p>You can remove the icon, sharp the borders and remove the shadow of the notifications</p>
                        <button id="pnotify-style-withouticon" class="btn btn-wide btn-o btn-primary">Without Icon</button>
                        <button id="pnotify-style-sharp" class="btn btn-wide btn-o btn-primary">Sharp borders</button>
                        <button id="pnotify-style-withoutshadow" class="btn btn-wide btn-o btn-primary">Without Shadow</button>
                    </div>
                    <!--FEATURE-->
                    <div class="col-md-12 mt-lg">
                        <h5><b>Feature</b> of the notice</h5>
                        <p>You can set featured as non-blocking, sticky and click to close the notifications</p>
                        <button id="pnotify-feature-nonblocking" class="btn btn-wide btn-o btn-primary">Non-blocking</button>
                        <button id="pnotify-feature-sticky" class="btn btn-wide btn-o btn-primary">Sticky</button>
                        <button id="pnotify-feature-click" class="btn btn-wide btn-o btn-primary">Click to close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!-- BARS NOFICATIONS -->
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Bars</b> Notifications</h4>
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <!--TOP BAR-->
                    <div class="col-md-12">
                        <h5><b>Top Bar</b> notifications</h5>
                        <button id="pnotify-topbar-success" class="btn btn-wide btn-success">Success</button>
                        <button id="pnotify-topbar-error" class="btn btn-wide btn-danger">Error</button>
                        <button id="pnotify-topbar-primary" class="btn btn-wide btn-primary">Primary</button>
                        <button id="pnotify-topbar-dark" class="btn btn-wide btn-dark">Dark</button>
                    </div>
                    <!--BOTTON BAR-->
                    <div class="col-md-12 mt-lg">
                        <h5><b>Bottom Bar</b> notifications</h5>
                        <button id="pnotify-bottombar-success" class="btn btn-wide btn-success">Success</button>
                        <button id="pnotify-bottombar-error" class="btn btn-wide btn-danger">Error</button>
                        <button id="pnotify-bottombar-primary" class="btn btn-wide btn-primary">Primary</button>
                        <button id="pnotify-bottombar-dark" class="btn btn-wide btn-dark">Dark</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--MODALS NOTIFICATIONS-->
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Modal</b> Notifications</h4>
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <div class="col-md-12">
                        <button id="pnotify-modal-success" class="btn btn-wide btn-success">Success</button>
                        <button id="pnotify-modal-warning" class="btn btn-wide btn-warning">Warning</button>
                        <button id="pnotify-modal-error" class="btn btn-wide btn-danger">Error</button>
                        <button id="pnotify-modal-info" class="btn btn-wide btn-info">Info</button>
                        <button id="pnotify-modal-primary" class="btn btn-wide btn-primary">Primary</button>
                        <button id="pnotify-modal-dark" class="btn btn-wide btn-dark">Dark</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
@endsection
@section('script')
    <!--pNotify-->
    <script src="{{ asset('vendor/pnotify/pnotify.custom.js') }}"></script>
    <!--Examples-->
    <script src="{{ asset('js/examples/ui-elements/notifications-pnotify.js') }}"></script>
@stop
@section('css')
    <!--pNotify-->
     <link rel="stylesheet" href="{{ asset('vendor/pnotify/pnotify.custom.css') }}">
@stop

