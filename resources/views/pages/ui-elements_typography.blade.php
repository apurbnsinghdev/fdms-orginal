@extends('layouts.admin')
@section('content')
<!-- ========================================================= -->
<div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">UI Elements</a></li>
            <li><a>Typography</a></li>
        </ul>
    </div>
</div>

<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<div class="row animated fadeInUp">
    <!--SIZES-->
    <div class="col-sm-12">
        <h4 class="section-subtitle">Typography <b>Sizes</b></h4>
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <!--DEFAULT SIZES-->
                    <div class="col-md-6">
                        <h5 class="mb-lg"><b>Default</b> sizes</h5>
                        <p>p paragraph size</p>
                        <h6>h6 heading size</h6>
                        <h5>h5 heading size</h5>
                        <h4>h4 heading size</h4>
                        <h3>h3 heading size</h3>
                        <h2>h2 heading size</h2>
                        <h1>h1 heading size</h1>
                    </div>
                    <!--CLASS SIZES-->
                    <div class="col-md-6">
                        <h5><b>Class</b> sizes</h5>
                        <p class="mb-lg">To change the default size you can use the class <span class="code">.text-[size]</span></p>
                        <p class="text-xs">p paragraph with the class <span class="code">.text-xs</span></p>
                        <p class="text-sm">p paragraph with the class <span class="code">.text-sm</span></p>
                        <p class="text-md">p paragraph with the class <span class="code">.text-md</span></p>
                        <p class="text-lg">p paragraph with the class <span class="code">.text-lg</span></p>
                        <p class="text-xl">p paragraph with the class <span class="code">.text-xl</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--COLORS-->
    <div class="col-sm-12">
        <h4 class="section-subtitle">Typography <b>Colors</b></h4>
        <p class="section-text">Add the class <span class="code">.color-[name]</span></p>

        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <!--BASIC COLORS-->
                    <div class="col-md-4">
                        <h5 class="mb-lg"><b>Basic</b> colors</h5>
                        <h4 class="color-success">Heading with color Success</h4>
                        <p class="color-success">paragraph with color Success</p>
                        <h4 class="color-warning">Heading with color Warning</h4>
                        <p class="color-warning">paragraph with color Warning</p>
                        <h4 class="color-danger">Heading with color Danger</h4>
                        <p class="color-danger">paragraph with color Danger</p>
                        <h4 class="color-info">Heading with color Info</h4>
                        <p class="color-info">paragraph with color Info</p>
                    </div>
                    <!--PRIMARY COLORS-->
                    <div class="col-md-4">
                        <h5 class="mb-lg"><b>Primary</b> colors</h5>

                        <h4 class="color-darker-1">Heading with color Darker-1</h4>
                        <p class="color-darker-1">paragraph with color Darker-1</p>
                        <h4 class="color-primary">Heading with color Primary</h4>
                        <p class="color-primary">paragraph with color Primary</p>
                        <h4 class="color-lighter-1">Heading with color Lighter-1</h4>
                        <p class="color-lighter-1">paragraph with color Lighter-1</p>
                    </div>

                    <!--LIGHT & DARK COLORS-->
                    <div class="col-md-4">
                        <h5 class="mb-lg"><b>Ligth & Dark</b> colors</h5>

                        <h4 class="color-dark">Heading with color Dark</h4>
                        <p class="color-dark">paragraph with color Dark</p>
                        <h4 class="color-muted">Heading with color Muted</h4>
                        <p class="color-muted">paragraph with color Muted</p>
                        <div class="bg-scale-3 p-xs" style="display: inline-block">
                            <h4 class="color-light">Heading with color Light</h4>
                            <p class="color-light">paragraph with color Light</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--FEATURE-->
    <div class="col-sm-12">
        <h4 class="section-subtitle">Typography <b>Feature</b></h4>
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <!--ALIGMENTS-->
                    <div class="col-md-6">
                        <h5 class="mb-lg"><b>Alignments</b> of the text</h5>
                        <p class="text-left">Lorem ipsum dolor sit amet <span class="code">.text-left</span></p>
                        <p class="text-center">Lorem ipsum dolor sit amet <span class="code">.text-center</span></p>
                        <p class="text-right">Lorem ipsum dolor sit amet <span class="code">.text-right</span></p>
                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad, asperiores delectus, earum eum explicabo facilis id incidunt iusto molestias nihil pariatur quis ratione vero! Assumenda expedita fugiat quaerat quos sunt. <span class="code">.text-justift</span></p>
                    </div>
                    <!--STYLE-->
                    <div class="col-md-6">
                        <h5 class="mb-lg"><b>Styles</b> of the text</h5>
                        <p class="text-bold">Lorem ipsum dolor sit amet <span class="code">.text-bold</span></p>
                        <p class="text-italic">Lorem ipsum dolor sit amet <span class="code">.text-italic</span></p>
                        <p class="text-capitalize">Lorem ipsum dolor sit amet <span class="code">.text-capitalize</span></p>
                        <p class="text-uppercase">Lorem ipsum dolor sit amet <span class="code">.text-uppercase</span></p>
                        <p class="text-lowercase">Lorem ipsum dolor sit amet <span class="code">.text-lowercase</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--BLOCKQUOTES-->
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Blockquotes</b></h4>
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <div class="col-md-12">
                        <!--BASIC BLOCKQUOTE-->
                        <h5><b>Basic</b> blockquote</h5>
                        <p> Wrap the quote with the tag <span class="code">&lt;blockquote></span> to use the basic structure</p>
                        <blockquote>
                            <p>"I learned life and death are always so mixed up together, in the same way some beginnings are endings, and some endings become beginnings."</p>
                            <small>Capheus, Sense8</small>
                        </blockquote>
                        <!--RIGHT SIDE BLOCKQUOTE-->
                        <h5 class="text-right"><b>Right side</b> blockquote</h5>
                        <p class="text-right"> Add the class <span class="code">blockquote-reverse</span> </p>
                        <blockquote class="blockquote-reverse">
                            <p>"It’s not the drugs that make a drug addict, it’s the need to escape reality."</p>
                            <small>Riley Blue, Sense8</small>
                        </blockquote>
                        <!-- BORDER WIDTH BLOCKQUOTE-->
                        <h5><b>Border Width</b> blockquote</h5>
                        <p>Remove or change the width of the border with the class <span class="code">.b-[size]</span></p>
                        <blockquote class="b-primary b-none">
                            <p>"The past is done with us the moment we are done with it."</p>
                            <small>Sun Bak, Sense8 <span class="code">.b-none</span></small>
                        </blockquote>
                        <blockquote class="b-primary bl-xs">
                            <p>"He is my brother. Not by something as accidental as blood. By something much stronger. By choice."</p>
                            <small>Wolfgang Bogdanow, Sense8 <span class="code">.bl-xs</span></small>
                        </blockquote>
                        <blockquote class="b-primary bl-sm">
                            <p>"There’s a huge difference between what we work for and what we live for."</p>
                            <small>Nomi Marks, Sense8 <span class="code">.bl-sm</span></small>
                        </blockquote>
                        <blockquote class="b-primary bl-md">
                            <p>"It’s obedience, not resistance. That’s the glue of every country, every army, every religion in the world."</p>
                            <small>Felix, Sense8 <span class="code">.bl-md</span></small>
                        </blockquote>
                        <blockquote class="b-primary bl-lg">
                            <p>"All beauty is temporary. Decay and death haunt every breath we take."</p>
                            <small>Lito Rodriguez, Sense8 <span class="code">.bl-lg</span></small>
                        </blockquote>
                        <blockquote class="b-primary bl-xl">
                            <p>"Death doesn’t let you say goodbye. It just carves holes in your life, in your future, in your heart."</p>
                            <small>Riley Blue, Sense8 <span class="code">.bl-xl</span></small>
                        </blockquote>
                        <!--BORDER STYLE BLOCKQUOTE-->
                        <h5 class="pt-lg"><b>Border style</b> blockquote</h5>
                        <p>Set the border rounded width <span class="code">.b-rounded</span></p>
                        <blockquote class=" b-primary bl-md b-rounded">
                            <p>"This is what life is. Fear, rage, desire... love. To stop feeling emotions, to stop wanting to feel them, is to feel death."</p>
                            <small>Sun Bak, Sense8</small>
                        </blockquote>
                        <!--BORDER COLORS BLOCKQUOTE-->
                        <h5 class="pt-lg"><b>Border colors</b> blockquote</h5>
                        <p>Set the border color with the class <span class="code">.b-[color]</span></p>
                        <div class="col-md-6">
                            <blockquote>
                                <p>"Blockquote default border color"</p>
                            </blockquote>
                            <blockquote class="b-success bl-md">
                                <p>"Blockquote with the class <span class="code">.b-success</span>"</p>
                            </blockquote>
                            <blockquote class="b-warning bl-md">
                                <p>"Blockquote with the class <span class="code">.b-warning</span>"</p>
                            </blockquote>
                            <blockquote class="b-danger bl-md">
                                <p>"Blockquote with the class <span class="code">.b-danger</span>"</p>
                            </blockquote>
                            <blockquote class="b-info bl-md">
                                <p>"Blockquote with the class <span class="code">.b-info</span>"</p>
                            </blockquote>
                        </div>
                        <div class="col-md-6">
                            <blockquote class="b-darker-1 bl-md">
                                <p>"Blockquote with the class <span class="code">.b-darker-1</span>"</p>
                            </blockquote>
                            <blockquote class="b-primary bl-md">
                                <p>"Blockquote with the class <span class="code">.b-primary</span>"</p>
                            </blockquote>
                            <blockquote class="b-lighter-1 bl-md">
                                <p>"Blockquote with the class <span class="code">.b-lighter-1</span>"</p>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
@endsection
