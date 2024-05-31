@extends('layouts.admin')
@section('content')
<!-- ========================================================= -->
<div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">UI Elements</a></li>
            <li><a>Buttons</a></li>
        </ul>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<div class="row animated fadeInUp">
    <!--BUTTONS STYLE-->
    <div class="col-sm-12">
        <h4 class="section-subtitle">Buttons <b>Style</b></h4>
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <!--BASIC COLORS-->
                    <div class="col-sm-12">
                        <h5><b>Basic</b> Buttons</h5>
                        <p>You can use <span class="code"> &lt;a> </span> or <span class="code"> &lt;button></span> elements with class<span class="code">.btn</span> and <span class="code">.btn-[name]</span></p>
                        <button class="btn btn-wide ">Default</button>
                        <button class="btn btn-wide btn-success">Success</button>
                        <button class="btn btn-wide btn-warning">Warning</button>
                        <button class="btn btn-wide btn-danger">Danger</button>
                        <button class="btn btn-wide btn-info">Info</button>
                    </div>
                    <!--PRIMARY COLORS-->
                    <div class="col-sm-12 mt-md">
                        <h5><b>Primary</b> Buttons</h5>
                        <p>Primary colors buttons <span class="code">.btn</span> and <span class="code">.btn-[name]</span></p>
                        <button class="btn btn-wide btn-darker-1">darker-1</button>
                        <button class="btn btn-wide btn-primary">primary</button>
                        <button class="btn btn-wide btn-lighter-1">lighter-1</button>
                    </div>
                    <!--OUTLINE COLORS-->
                    <div class="col-sm-12 mt-md mb-lg">
                        <h5><b>Outline</b> Buttons</h5>
                        <p>Outline buttons <span class="code">.btn</span>, <span class="code">.btn-o</span> and <span class="code">.btn-[name]</span></p>
                        <div class="row">
                            <div class="col-sm-12">
                                <button class="btn btn-wide btn-o btn-success">Success</button>
                                <button class="btn btn-wide btn-o btn-warning">Warning</button>
                                <button class="btn btn-wide btn-o btn-danger">Danger</button>
                                <button class="btn btn-wide btn-o btn-info">Info</button>
                            </div>
                            <div class="col-sm-12">
                                <button class="btn btn-wide btn-o btn-darker-1">darker-1</button>
                                <button class="btn btn-wide btn-o btn-primary">primary</button>
                                <button class="btn btn-wide btn-o btn-lighter-1">lighter-1</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <p>* All this buttons have the class <span class="code">.btn-wide</span> that set de min with to 120px</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--BUTTONS SIZES-->
    <div class="col-sm-12">
        <h4 class="section-subtitle">Buttons <b>Sizes</b></h4>
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <div class="col-sm-12">
                        <p>Add the class <span class="code">.btn-[size]</span></p>
                        <button class="btn btn-wide btn-primary btn-lg">Button size lg</button>
                        <button class="btn btn-wide btn-primary ">Button default</button>
                        <button class="btn btn-wide btn-primary btn-sm">Button size sm</button>
                        <button class="btn btn-wide btn-primary btn-xs">Button size xs</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--BUTTONS WIDTH-->
    <div class="col-sm-12">
        <h4 class="section-subtitle">Buttons <b>Width</b></h4>
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <!--INLINE BUTTONS-->
                    <div class="col-sm-12">
                        <h5><b>Inline</b> format</h5>
                        <p>Deafult fortmat</p>
                        <button class="btn btn-primary">inline</button>
                        <button class="btn btn-success">inline</button>
                        <button class="btn btn-warning">inline</button>
                        <button class="btn btn-danger">inline</button>
                    </div>
                    <!--MIN WIDTH BUTTONS-->
                    <div class="col-sm-12">
                        <h5><b>Min-width</b> format</h5>
                        <p>With the class <span class="code">.btn-wide</span> you set de min width of the buttons to 120px </p>
                        <button class="btn btn-wide btn-primary">wide</button>
                        <button class="btn btn-wide btn-success">wide</button>
                        <button class="btn btn-wide btn-warning">wide</button>
                        <button class="btn btn-wide btn-danger">wide</button>
                    </div>
                    <!--BLOCK BUTTONS-->
                    <div class="col-sm-12">
                        <h5><b>Block</b> format</h5>
                        <p>With the clas <span class="code">.btn-block</span> buttons span to the full width of their parents </p>
                        <div class="col-xs-4">
                            <button class="btn btn-darker-1 btn-block">block</button>
                            <button class="btn btn-primary btn-block">block</button>
                            <button class="btn btn-lighter-1 btn-block">block</button>
                        </div>
                        <div class="col-xs-8">
                            <button class="btn btn-darker-1 btn-block">block</button>
                            <button class="btn btn-primary btn-block">block</button>
                            <button class="btn btn-lighter-1 btn-block">block</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--BUTTONS GROUPS -->
    <div class="col-sm-12">
        <h4 class="section-subtitle">Buttons <b>Groups</b></h4>
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <!--INLINE BUTTONS-->
                    <div class="col-sm-6">
                        <h5><b>Horizontal</b> group</h5>
                        <p>Wrap the buttons with a div<span class="code">.btn-group</span></p>
                        <div class="btn-group">
                            <button class="btn btn-darker-1">element 1</button>
                            <button class="btn btn-primary">element 1</button>
                            <button class="btn btn-lighter-1">element 4</button>
                        </div>
                    </div>
                    <!--BLOCK BUTTONS-->
                    <div class="col-sm-6">
                        <h5><b>Vertical</b> group</h5>
                        <p>Wrap the buttons with a div<span class="code">.btn-group-vertical</span></p>
                        <div class="btn-group-vertical">
                            <button class="btn btn-wide btn-darker-1 ">Section 1</button>
                            <button class="btn btn-wide btn-primary ">Section 2</button>
                            <button class="btn btn-wide btn-lighter-1 ">Section 4</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--BUTTON LOADING -->
    <div class="col-sm-12">
        <h4 class="section-subtitle">Buttons <b>Loading</b></h4>
        <div class="panel">
            <div class="panel-content">
                <p>Add the class <span class="code">.btn-loading</span>. To start call <b>loadingButton()</b> and to stop <b>loadingButton({action:'stop'})</b>.</p>
                <p class="mb-xl">You can use <span class="code">data-loading-text='[your text]'</span> and <span class="code">data-loading-icon='[font-Awesome icon]'</span> </p>

                <div class="row text-center">
                    <div class="col-sm-4">
                        <h6>Default settings</h6>
                        <button class="btn btn-wide btn-loading btn-primary">Loading button</button>
                    </div>
                    <div class="col-sm-4">
                        <h6><span class="code">data-loading-text="please wait.."</span></h6>
                        <button class="btn btn-wide btn-loading btn-primary" data-loading-text="please wait..">Loading button</button>
                    </div>
                    <div class="col-sm-4">
                        <h6><span class="code">data-loading-icon="fa fa-refresh"</span></h6>
                        <button class="btn btn-wide btn-loading btn-primary" data-loading-icon="fa fa-refresh">Loading button</button>
                    </div>
                    <div class="col-sm-12 mt-lg">
                        <p>Set settings on call <b>loadingButton({text:'charging', icon:'fa fa-circle-o-notch')</b></p>
                        <button id="btn-options" class="btn btn-wide btn-loading btn-primary">Loading button</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
@endsection
@section('script')
    <!--Examples-->
    <script src="{{ asset('js/examples/ui-elements/buttons.js') }}"></script>
@stop
