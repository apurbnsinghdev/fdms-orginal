@extends('layouts.admin')
@section('content')
<!-- ========================================================= -->
<div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-magic" aria-hidden="true"></i><a href="#">Helpers</a></li>
            <li><a>Background & Border</a></li>
        </ul>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<div class="animated fadeInUp">
    <!--BACKGROUNDS COLORS-->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="section-subtitle text-center"><b>Backgrounds & Borders </b> helpers classes</h4>
            <p class="section-text text-center">This are classes that would help you to personalize your page <span class="highlight">very easy</span></p>
        </div>
        <div class="col-sm-12">
            <h4 class="section-subtitle">Backgrounds <b>Colors</b></h4>
            <div class="panel">
                <div class="panel-content">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5><b>Primary</b> backgrounds</h5>
                            <div class="panel p-sm bg-darker-2"><span class="code">.bg-darker-2</span></div>
                            <div class="panel p-sm bg-darker-1"><span class="code">.bg-darker-1</span></div>
                            <div class="panel p-sm bg-primary"><span class="code">.bg-primary</span></div>
                            <div class="panel p-sm bg-lighter-1"><span class="code">.bg-lighter-1</span></div>
                            <div class="panel p-sm bg-lighter-2"><span class="code">.bg-lighter-2</span></div>
                        </div>
                        <div class="col-sm-6">
                            <h5><b>States</b> backgrounds</h5>
                            <div class="panel p-sm bg-success"><span class="code">.bg-success</span></div>
                            <div class="panel p-sm bg-warning"><span class="code">.bg-warning</span></div>
                            <div class="panel p-sm bg-danger"><span class="code">.bg-danger</span></div>
                            <div class="panel p-sm bg-info"><span class="code">.bg-info</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--BORDER COLORS-->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="section-subtitle">Border <b>Colors</b></h4>
            <div class="panel">
                <div class="panel-content">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5><b>Primary</b> borders</h5>
                            <div class="panel b-darker-1 b-md">
                                <div class="panel-content">
                                    <span class="code">.b-darker-1</span>
                                </div>
                            </div>
                            <div class="panel b-primary b-md">
                                <div class="panel-content">
                                    <span class="code">.b-primary</span>
                                </div>
                            </div>
                            <div class="panel b-lighter-1 b-md">
                                <div class="panel-content">
                                    <span class="code">.b-lighter-1</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <h5><b>States</b> borders</h5>
                            <div class="panel b-success b-md ">
                                <div class="panel-content">
                                    <span class="code">.b-success</span>
                                </div>
                            </div>
                            <div class="panel b-warning b-md ">
                                <div class="panel-content">
                                    <span class="code">.b-warning</span>
                                </div>
                            </div>
                            <div class="panel b-danger b-md ">
                                <div class="panel-content">
                                    <span class="code">.b-danger</span>
                                </div>
                            </div>
                            <div class="panel b-info b-md ">
                                <div class="panel-content">
                                    <span class="code">.b-info</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--BORDER WIDTH-->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="section-subtitle">Border <b>width</b></h4>
        </div>
        <div class="col-sm-4 col-md-2">
            <div class="panel b-primary b-none">
                <div class="panel-content">
                    <span class="code">.b-none</span>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-md-2">
            <div class="panel b-primary b-xs">
                <div class="panel-content">
                    <span class="code">.b-xs</span>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-md-2">
            <div class="panel b-primary b-sm">
                <div class="panel-content">
                    <span class="code">.b-sm</span>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-md-2">
            <div class="panel b-primary b-md">
                <div class="panel-content">
                    <span class="code">.b-md</span>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-md-2">
            <div class="panel b-primary b-lg">
                <div class="panel-content">
                    <span class="code">.b-lg</span>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-md-2">
            <div class="panel b-primary b-xl">
                <div class="panel-content">
                    <span class="code">.b-xl</span>
                </div>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--BORDER POSITION-->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="section-subtitle">Border <b>Positions</b></h4>
        </div>
        <div class="col-sm-3">
            <div class="panel b-primary bt-xs">
                <div class="panel-content">
                    <span class="code">.bt-xs</span>
                </div>
            </div>
            <div class="panel b-primary bt-sm">
                <div class="panel-content">
                    <span class="code">.bt-sm</span>
                </div>
            </div>
            <div class="panel b-primary bt-md">
                <div class="panel-content">
                    <span class="code">.bt-md</span>
                </div>
            </div>
            <div class="panel b-primary bt-lg">
                <div class="panel-content">
                    <span class="code">.bt-lg</span>
                </div>
            </div>
            <div class="panel b-primary bt-xl">
                <div class="panel-content">
                    <span class="code">.bt-xl</span>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="panel b-primary br-xs">
                <div class="panel-content">
                    <span class="code">.br-xs</span>
                </div>
            </div>
            <div class="panel b-primary br-sm">
                <div class="panel-content">
                    <span class="code">.br-sm</span>
                </div>
            </div>
            <div class="panel b-primary br-md">
                <div class="panel-content">
                    <span class="code">.br-md</span>
                </div>
            </div>
            <div class="panel b-primary br-lg">
                <div class="panel-content">
                    <span class="code">.br-lg</span>
                </div>
            </div>
            <div class="panel b-primary br-xl">
                <div class="panel-content">
                    <span class="code">.br-xl</span>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="panel b-primary bb-xs">
                <div class="panel-content">
                    <span class="code">.bb-xs</span>
                </div>
            </div>
            <div class="panel b-primary bb-sm">
                <div class="panel-content">
                    <span class="code">.bb-sm</span>
                </div>
            </div>
            <div class="panel b-primary bb-md">
                <div class="panel-content">
                    <span class="code">.bb-md</span>
                </div>
            </div>
            <div class="panel b-primary bb-lg">
                <div class="panel-content">
                    <span class="code">.bb-lg</span>
                </div>
            </div>
            <div class="panel b-primary bb-xl">
                <div class="panel-content">
                    <span class="code">.bb-xl</span>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="panel b-primary bl-xs">
                <div class="panel-content">
                    <span class="code">.bl-xs</span>
                </div>
            </div>
            <div class="panel b-primary bl-sm">
                <div class="panel-content">
                    <span class="code">.bl-sm</span>
                </div>
            </div>
            <div class="panel b-primary bl-md">
                <div class="panel-content">
                    <span class="code">.bl-md</span>
                </div>
            </div>
            <div class="panel b-primary bl-lg">
                <div class="panel-content">
                    <span class="code">.bl-lg</span>
                </div>
            </div>
            <div class="panel b-primary bl-xl">
                <div class="panel-content">
                    <span class="code">.bl-xl</span>
                </div>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--BORDER STYLES-->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="section-subtitle">Border <b>Styles</b></h4>
        </div>
        <div class="col-sm-4">
            <div class="panel b-primary b-md b-rounded">
                <div class="panel-content">
                    <span class="code">.b-rounded</span>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="panel b-primary b-md b-straight ">
                <div class="panel-content">
                    <span class="code">.b-straight</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
@endsection
