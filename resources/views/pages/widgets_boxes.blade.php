@extends('layouts.admin')
@section('content')
<!-- ========================================================= -->
<div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-paper-plane" aria-hidden="true"></i><a href="#">Widgets</a></li>
            <li><a>Post</a></li>
        </ul>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<div class="animated fadeInRight">
    <!--WIDGET BOX STYLE 1-->
    <h4 class="section-subtitle"><b>Style 1</b> WidgetBox</h4>
    <div class="row">
        <!--BOX Style 1-->
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="panel widgetbox wbox-1 bg-darker-1">
                <a href="#">
                    <div class="panel-content">
                        <h1 class="title color-w"><i class="fa fa-globe"></i> Views </h1>
                        <h4 class="subtitle color-lighter-1">154.609</h4>
                    </div>
                </a>
            </div>
        </div>
        <!--BOX Style 1-->
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="panel widgetbox wbox-1 bg-darker-2 color-light">
                <a href="#">
                    <div class="panel-content">
                        <h1 class="title color-light-1"> <i class="fa fa-envelope"></i> 124 </h1>
                        <h4 class="subtitle">New Messages</h4>
                    </div>
                </a>
            </div>
        </div>
        <!--BOX Style 1-->
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="panel widgetbox wbox-1 bg-lighter-2 color-light">
                <a href="#">
                    <div class="panel-content">
                        <h1 class="title color-darker-2"> <i class="fa fa-user"></i> 105 </h1>
                        <h4 class="subtitle color-darker-1">New Users</h4>
                    </div>
                </a>
            </div>
        </div>
        <!--BOX Style 1-->
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="panel widgetbox wbox-1 bg-light color-darker-2">
                <a href="#">
                    <div class="panel-content">
                        <h1 class="title"> Total </h1>
                        <h4 class="subtitle">$14.550,00</h4>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--WIDGET BOX STYLE 2-->
    <h4 class="section-subtitle"><b>Style 2</b> WidgetBox</h4>
    <div class="row">
        <!--BOX Style 2-->
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="panel widgetbox wbox-2 bg-darker-1">
                <a href="#">
                    <div class="panel-content">
                        <div class="row">
                            <div class="col-xs-4">
                                <span class="icon fa fa-globe color-lighter-1"></span>
                            </div>
                            <div class="col-xs-8">
                                <h4 class="subtitle color-lighter-1">Views</h4>
                                <h1 class="title color-light"> 154.609</h1>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <!--BOX Style 2-->
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="panel widgetbox wbox-2 bg-darker-2 color-light">
                <a href="#">
                    <div class="panel-content">
                        <div class="row">
                            <div class="col-xs-4">
                                <span class="icon fa fa-envelope color-lighter-1"></span>
                            </div>
                            <div class="col-xs-8">
                                <h4 class="subtitle color-lighter-1">New Messages</h4>
                                <h1 class="title color-light"> 124</h1>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <!--BOX Style 2-->
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="panel widgetbox wbox-2 bg-lighter-2 color-light">
                <a href="#">
                    <div class="panel-content">
                        <div class="row">
                            <div class="col-xs-4">
                                <span class="icon fa fa-user color-darker-2"></span>
                            </div>
                            <div class="col-xs-8">
                                <h4 class="subtitle color-darker-2">New Users</h4>
                                <h1 class="title color-w"> 105</h1>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <!--BOX Style 2-->
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="panel widgetbox wbox-2 bg-light color-darker-2">
                <a href="#">
                    <div class="panel-content">
                        <div class="row">
                            <div class="col-xs-4">
                                <span class="icon fa fa-dollar color-darker-2"></span>
                            </div>
                            <div class="col-xs-8">
                                <h4 class="subtitle">Total</h4>
                                <h1 class="title"> 14.550,00</h1>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--WIDGET BOX STYLE 3-->
    <h4 class="section-subtitle"><b>Style 3</b> WidgetBox</h4>
    <div class="row">
        <!--BOX Style 3-->
        <div class="col-sm-4 col-lg-2">
            <div class="panel widgetbox wbox-3 bg-danger">
                <a href="#">
                    <div class="panel-content">
                        <span class="icon fa fa-warning"></span>
                        <h1 class="title">Alert</h1>
                        <h4 class="subtitle">Server down</h4>
                    </div>
                </a>
            </div>
        </div>
        <!--BOX Style 3-->
        <div class="col-sm-4 col-lg-2">
            <div class="panel widgetbox wbox-3 bg-success">
                <a href="#">
                    <div class="panel-content">
                        <span class="icon fa fa-check"></span>
                        <h1 class="title">24</h1>
                        <h4 class="subtitle">Task completed</h4>
                    </div>
                </a>
            </div>
        </div>
        <!--BOX Style 3-->
        <div class="col-sm-4 col-lg-2">
            <div class="panel widgetbox wbox-3 bg-warning">
                <a href="#">
                    <div class="panel-content">
                        <span class="icon fa fa-exclamation "></span>
                        <h1 class="title">Warning</h1>
                        <h4 class="subtitle">8 bugs reported</h4>
                    </div>
                </a>
            </div>
        </div>
        <!--BOX Style 3-->
        <div class="col-sm-4 col-lg-2">
            <div class="panel widgetbox wbox-3 bg-primary ">
                <a href="#">
                    <div class="panel-content">
                        <span class="icon fa fa-thumbs-up"></span>
                        <h1 class="title color-darker-2">Likes</h1>
                        <h4 class="numbers"><b>143</b></h4>
                    </div>
                </a>
            </div>
        </div>
        <!--BOX Style 3-->
        <div class="col-sm-4 col-lg-2">
            <div class="panel widgetbox wbox-3 bg-lighter-1 ">
                <a href="#">
                    <div class="panel-content">
                        <span class="icon fa fa-bell  color-darker-2"></span>
                        <h1 class="title">27</h1>
                        <h4 class="subtitle color-darker-1">Notifications</h4>
                    </div>
                </a>
            </div>
        </div>
        <!--BOX Style 3-->
        <div class="col-sm-4 col-lg-2">
            <div class="panel widgetbox wbox-3 bg-darker-2 ">
                <a href="#">
                    <div class="panel-content">
                        <span class="icon fa fa-globe color-lighter-1"></span>
                        <h1 class="title">1262</h1>
                        <h4 class="subtitle color-lighter-1">Visits</h4>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--WIDGET BOX STYLE 4-->
    <h4 class="section-subtitle"><b>Style 4</b> WidgetBox</h4>
    <div class="row">
        <!--BOX Style 4-->
        <div class="col-sm-4 col-lg-2">
            <div class="panel widgetbox wbox-4 bg-primary ">
                <div class="owl-carousel">
                    <div class="item">
                        <span class="icon fa fa-globe color-darker-2"></span>
                        <h1 class="title">1262</h1>
                        <h4 class="subtitle color-darker-2">Visits</h4>
                    </div>
                    <div class="item">
                        <span class="icon fa fa-bell  color-darker-2"></span>
                        <h1 class="title">27</h1>
                        <h4 class="subtitle color-darker-2">Notifications</h4>
                    </div>
                    <div class="item">
                        <span class="icon fa fa-thumbs-up"></span>
                        <h1 class="subtitle color-darker-2">Likes</h1>
                        <h4 class="title"><b>143</b></h4>
                    </div>
                </div>
            </div>
        </div>
        <!--BOX Style 4-->
        <div class="col-sm-4 col-sm-3">
            <div class="panel widgetbox wbox-4 bg-darker-2 ">
                <div class="owl-carousel">
                    <div class="item">
                        <span class="icon fa fa-thumbs-up"></span>
                        <h1 class="subtitle color-lighter-2">Likes</h1>
                        <h4 class="title"><b>143</b></h4>
                    </div>
                    <div class="item">
                        <span class="icon fa fa-globe color-lighter-1"></span>
                        <h1 class="title">1262</h1>
                        <h4 class="subtitle color-lighter-1">Visits</h4>
                    </div>
                    <div class="item">
                        <span class="icon fa fa-bell  color-lighter-2"></span>
                        <h1 class="title">27</h1>
                        <h4 class="subtitle color-lighter-1">Notifications</h4>
                    </div>
                </div>
            </div>
        </div>
        <!--BOX Style 4-->
        <div class="col-sm-4 col-sm-3">
            <div class="panel widgetbox wbox-4 bg-danger ">
                <div class="owl-carousel">
                    <div class="item">
                        <span class="icon fa fa-warning"></span>
                        <h1 class="subtitle">Server 3</h1>
                        <h1 class="title">Down</h1>
                    </div>
                    <div class="item">
                        <span class="icon fa fa-flag"></span>
                        <h4 class="subtitle">Bugs reported</h4>
                        <h1 class="title">12</h1>
                    </div>
                    <div class="item">
                        <span class="icon fa fa-server"></span>
                        <h4 class="subtitle">10%</h4>
                        <h1 class="title">disk space</h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
@endsection
@section('script')
    <!--owl-carousel-->
    <script src="{{ asset('vendor/owl-carousel/owl.carousel.min.js') }}"></script>
    <script>
    $('.owl-carousel').owlCarousel({
        loop: true,
        autoplay: true,
        items: 1
    })
</script>
@stop
@section('css')
    <!--owl-carousel-->
    <link rel="stylesheet" href="{{ asset('vendor/owl-carousel/owl.carousel.min.css') }}">
@stop
