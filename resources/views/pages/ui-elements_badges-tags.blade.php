@extends('layouts.admin')
@section('content')
<!-- ========================================================= -->
<div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">UI Elements</a></li>
            <li><a>Badge & Tags</a></li>
        </ul>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<div class="row animated fadeInUp">
    <!--BADGE & TAGS  STYLE-->
    <div class="col-sm-12">
        <h4 class="section-subtitle">Badge & Tags <b>Style</b></h4>
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <!--BASIC COLORS-->
                    <div class="col-sm-6">
                        <h5><b>Basic</b> Badge & Tags</h5>
                        <p>You can use <span class="code"> &lt;span></span>, <span class="code">&lt;i> </span> or <span class="code"> &lt;a></span> elements with the class<span class="code">.badge</span> and <span class="code">.x-[name]</span></p>
                        <span class="badge ">Default</span>
                        <span class="badge x-success">Success</span>
                        <span class="badge x-warning">Warning</span>
                        <span class="badge x-danger">Danger</span>
                        <span class="badge x-info">Info</span>
                    </div>
                    <!--PRIMARY COLORS-->
                    <div class="col-sm-6">
                        <h5><b>Primary</b> Badge & Tags</h5>
                        <p>Primary colors buttons <span class="code">.badge</span> and <span class="code">.x-[name]</span></p>
                        <span class="badge x-darker-2">darker-2</span>
                        <span class="badge x-darker-1">darker-1</span>
                        <span class="badge x-primary">primary</span>
                        <span class="badge x-lighter-1">lighter-1</span>
                        <span class="badge x-lighter-2">lighter-2</span>
                    </div>
                    <!--OUTLINE COLORS-->
                    <div class="col-sm-12 mt-md">
                        <h5><b>Outline</b> Badge & Tags</h5>
                        <p>Outline buttons <span class="code">.badge</span>, <span class="code">.x-o</span> and <span class="code">.x-[name]</span></p>
                        <div class="row">
                            <div class="col-sm-12">
                                <span class="badge x-o x-success">Success</span>
                                <span class="badge x-o x-warning">Warning</span>
                                <span class="badge x-o x-danger">Danger</span>
                                <span class="badge x-o x-info">Info</span>

                                <span class="badge x-o x-darker-2">darker-2</span>
                                <span class="badge x-o x-darker-1">darker-1</span>
                                <span class="badge x-o x-primary">primary</span>
                                <span class="badge x-o x-lighter-1">lighter-1</span>
                                <span class="badge x-o x-lighter-2">lighter-2</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--BADGE & TAGS  BORDERS-->
    <div class="col-sm-12">
        <h4 class="section-subtitle">Badge & Tags  <b>Borders</b></h4>
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <div class="col-sm-6">
                        <p>Default border</p>
                        <span class="badge ">Default</span>
                        <span class="badge x-success">Success</span>
                        <span class="badge x-warning">Warning</span>
                        <span class="badge x-danger">Danger</span>
                        <span class="badge x-info">Info</span>
                        <span class="badge ">120</span>
                        <span class="badge x-success"><i class="fa fa-check"></i></span>
                        <span class="badge x-warning"><i class="fa fa-bell"></i></span>
                        <span class="badge x-danger">5</span>
                        <span class="badge x-info"><i class="fa fa-info"></i></span>
                    </div>
                    <div class="col-sm-6">

                        <p>Add the class <span class="code">.b-straight</span> for straigth border</p>
                        <span class="badge b-straight ">Default</span>
                        <span class="badge b-straight x-success">Success</span>
                        <span class="badge b-straight x-warning">Warning</span>
                        <span class="badge b-straight x-danger">Danger</span>
                        <span class="badge b-straight x-info">Info</span>
                        <span class="badge b-straight ">120</span>
                        <span class="badge b-straight x-success"><i class="fa fa-check"></i></span>
                        <span class="badge b-straight x-warning"><i class="fa fa-bell"></i></span>
                        <span class="badge b-straight x-danger">5</span>
                        <span class="badge b-straight x-info"><i class="fa fa-info"></i></span>
                    </div>
                    <div class="col-sm-6 mt-md">

                        <p>Add the class <span class="code">.b-rounded</span> for softer round border</p>
                        <span class="badge b-rounded ">Default</span>
                        <span class="badge b-rounded x-success">Success</span>
                        <span class="badge b-rounded x-warning">Warning</span>
                        <span class="badge b-rounded x-danger">Danger</span>
                        <span class="badge b-rounded x-info">Info</span>
                        <span class="badge b-rounded ">120</span>
                        <span class="badge b-rounded x-success"><i class="fa fa-check"></i></span>
                        <span class="badge b-rounded x-warning"><i class="fa fa-bell"></i></span>
                        <span class="badge b-rounded x-danger">5</span>
                        <span class="badge b-rounded x-info"><i class="fa fa-info"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--BADGE & TAGS  SIZES-->
    <div class="col-sm-12">
        <h4 class="section-subtitle">Badge & Tags  <b>Sizes</b></h4>
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <div class="col-sm-6">
                        <p>Add the class <span class="code">.badge-xs</span></p>
                        <span class="badge badge-xs x-success">Success</span>
                        <span class="badge badge-xs x-warning">Warning</span>
                        <span class="badge badge-xs x-danger">120</span>
                        <span class="badge badge-xs x-info"><i class="fa fa-bell"></i></span>
                    </div>
                    <div class="col-sm-6">
                        <p>Add the class <span class="code">.badge-xs</span></p>
                        <span class="badge badge-xs b-straight x-success">Success</span>
                        <span class="badge badge-xs b-straight x-warning">Warning</span>
                        <span class="badge badge-xs b-straight x-danger">120</span>
                        <span class="badge badge-xs b-straight x-info"><i class="fa fa-bell"></i></span>
                    </div>
                    <div class="col-sm-6 mt-md">
                        <p>Default size</p>
                        <span class="badge x-success">Success</span>
                        <span class="badge x-warning">Warning</span>
                        <span class="badge x-danger">120</span>
                        <span class="badge x-info"><i class="fa fa-bell"></i></span>
                    </div>
                    <div class="col-sm-6 mt-md">
                        <p>Default size</p>
                        <span class="badge b-straight x-success">Success</span>
                        <span class="badge b-straight x-warning">Warning</span>
                        <span class="badge b-straight x-danger">120</span>
                        <span class="badge b-straight x-info"><i class="fa fa-bell"></i></span>
                    </div>
                    <div class="col-sm-6 mt-md">
                        <p>Add the class <span class="code">.badge-md</span></p>
                        <span class="badge badge-md x-success">Success</span>
                        <span class="badge badge-md x-warning">Warning</span>
                        <span class="badge badge-md x-danger">120</span>
                        <span class="badge badge-md x-info"><i class="fa fa-bell"></i></span>
                    </div>
                    <div class="col-sm-6 mt-md">
                        <p>Add the class <span class="code">.badge-md</span></p>
                        <span class="badge b-straight badge-md x-success">Success</span>
                        <span class="badge b-straight badge-md x-warning">Warning</span>
                        <span class="badge b-straight badge-md x-danger">120</span>
                        <span class="badge b-straight badge-md x-info"><i class="fa fa-bell"></i></span>
                    </div>
                    <div class="col-sm-6 mt-md">
                        <p>Add the class <span class="code">.badge-lg</span></p>
                        <span class="badge badge-lg x-success">Success</span>
                        <span class="badge badge-lg x-warning">Warning</span>
                        <span class="badge badge-lg x-danger">120</span>
                        <span class="badge badge-lg x-info"><i class="fa fa-bell"></i></span>
                    </div>
                    <div class="col-sm-6 mt-md">
                        <p>Add the class <span class="code">.badge-lg</span></p>
                        <span class="badge b-straight badge-lg x-success">Success</span>
                        <span class="badge b-straight badge-lg x-warning">Warning</span>
                        <span class="badge b-straight badge-lg x-danger">120</span>
                        <span class="badge b-straight badge-lg x-info"><i class="fa fa-bell"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--BADGE & TAGS  POSITION-->
    <div class="col-sm-12">
        <h4 class="section-subtitle">Badge & Tags  <b>Positions</b></h4>
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <!--TOP-LEFT BADGE & TAGS -->
                    <div class="col-sm-6 col-md-3 text-center">
                        <h5><b>top-left</b></h5>
                        <p>Add the class <span class="code">badge-top-left</span></p>
                        <i class="fa fa-envelope-o text-xl"><span class="badge x-danger badge-top-left">5</span></i>
                    </div>
                    <!--TOP-RIGHT BADGE & TAGS -->
                    <div class="col-sm-6 col-md-3 text-center">
                        <h5><b>top-right</b></h5>
                        <p>Add the class <span class="code">badge-top-right</span></p>
                        <i class="fa fa-envelope-o text-xl"><span class="badge x-danger badge-top-right">5</span></i>
                    </div>
                    <!--BOTTOM-LEFT BADGE & TAGS -->
                    <div class="col-sm-6 col-md-3 text-center">
                        <h5><b>bottom-left</b></h5>
                        <p>Add the class <span class="code">badge-bottom-left</span></p>
                        <i class="fa fa-envelope-o text-xl"><span class="badge x-danger badge-bottom-left">5</span></i>
                    </div>
                    <!--BOTTOM-RIGHT BADGE & TAGS -->
                    <div class="col-sm-6 col-md-3 text-center">
                        <h5><b>bottom-right</b></h5>
                        <p>Add the class <span class="code">badge-bottom-right</span></p>
                        <i class="fa fa-envelope-o text-xl"><span class="badge x-danger badge-bottom-right">5</span></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
@endsection
@section('script')
    <!-- SECTION script and examples-->
    <script src="{{ asset('js/examples/ui-elements/buttons.js') }}"></script>
@stop
