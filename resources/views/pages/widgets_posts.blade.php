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
<div class="row animated fadeInUp">
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<!--WIDGET POST TYPE 1-->
<div class="col-sm-6 col-md-4">
    <!--Post type 1-->
    <div class="panel widget-post ">
        <div class="panel-header">
            <img alt="post photo" src="{{ asset('storage/images/post/post_1.jpg') }}" />
            <div class="main-tag"><span>Adventure</span></div>
        </div>
        <div class="panel-content">
            <div class="text text-center">
                <h4>The World's Best Natural Escapes </h4>
                <h6 class="color-muted">Join the adventure</h6>
                <hr class="mv-xs mh-lg" />
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur, illum iste magni nam quo saepe temporibus</p>
            </div>
        </div>
        <div class="panel-footer bg-scale-0 text-center pv-xs"><a href="#">Read more</a></div>
    </div>
    <!--Post type 1-->
    <div class="panel widget-post ">
        <div class="panel-header">
            <img alt="post photo" src="{{ asset('storage/images/post/post_2.jpg') }}" />
            <div class="main-tag"><span>Food</span></div>
        </div>
        <div class="panel-content">
            <div class="text text-center">
                <h4>How to create the perfect Dinner</h4>
                <h6 class="color-muted">For special occasions</h6>
                <hr class="mv-xs mh-lg" />
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur, illum iste magni nam quo saepe temporibus</p>
            </div>
        </div>
        <div class="panel-footer bg-scale-0 text-center pv-xs"><a href="#">Read more</a></div>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<!--WIDGET POST TYPE 2-->
<div class="col-sm-6 col-md-4 ">
    <!--Post type 2-->
    <div class="panel widget-post">
        <div class="panel-header">
            <img alt="post photo" src="{{ asset('storage/images/post/post_3.jpg') }}" />
            <div class="group-tag">
                <a href="#" class="badge">food</a>
                <a href="#" class="badge bg-primary color-light">pizza</a>
            </div>
        </div>
        <div class="panel-content">
            <div class="text">
                <h6 class="text-sm color-muted mv-xs">November 2016</h6>
                <a href="#" class="text-md color-dark text-bold">Why Pizza is the Best Food </a>
            </div>
        </div>
    </div>
    <!--Post type 2-->
    <div class="panel widget-post">
        <div class="panel-header">
            <img alt="post photo" src="{{ asset('storage/images/post/post_4.jpg') }}" />
            <div class="group-tag">
                <a href="#" class="badge">trip</a>
                <a href="#" class="badge">adventure</a>
            </div>
        </div>
        <div class="panel-content">
            <div class="text">
                <h6 class="text-sm color-muted mv-xs">November 2016</h6>
                <a href="#" class="text-md color-dark text-bold">10 Keys to a Great Adventure </a>
            </div>
        </div>
    </div>
    <!--Post type 2-->
    <div class="panel widget-post">
        <div class="panel-header">
            <img alt="post photo" src="{{ asset('storage/images/post/post_5.jpg') }}" />
            <div class="group-tag">
                <a href="#" class="badge">retro</a>
                <a href="#" class="badge">vintage</a>
                <a href="#" class="badge">style</a>
            </div>
        </div>
        <div class="panel-content">
            <div class="text">
                <h6 class="text-sm color-muted mv-xs">November 2016</h6>
                <a href="#" class="text-md color-dark text-bold">Retro is making a comeback</a>
            </div>
        </div>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<!--WIDGET POST TYPE 3-->
<div class="col-sm-6 col-md-4 ">
    <!--Post type 3-->
    <div class="panel widget-post">
        <div class="panel-header">
            <img alt="post photo" src="{{ asset('storage/images/post/post_6.jpg') }}" />
        </div>
        <div class="panel-content">
            <div class="text">
                <a href="#" class="text-md text-bold color-dark">Best things to do in Amsterdam</a>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus distinctio eos quam quidem tempora.</p>
            </div>
        </div>
        <div class="panel-footer">
            <span class="text-sm color-muted pull-right">November 2016</span>
            <a href="#"><i class="pr-sm fa fa-heart-o"></i><span>146</span></a>
            <a href="#"><i class="ph-sm fa fa-share"></i><span>39</span></a>
        </div>
    </div>
    <!--Post type 3-->
    <div class="panel widget-post">
        <div class="panel-header">
            <img alt="post photo" src="{{ asset('storage/images/post/post_7.jpg') }}" />
        </div>
        <div class="panel-content">
            <div class="text">
                <a href="#" class="text-md text-bold color-dark">Best places to sleep under the open sky </a>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus distinctio eos quam quidem tempora.</p>
            </div>
        </div>
        <div class="panel-footer">
            <span class="text-sm color-muted pull-right">November 2016</span>
            <a href="#"><i class="pr-sm fa fa-heart-o"></i><span>238</span></a>
            <a href="#"><i class="ph-sm fa fa-share"></i><span>27</span></a>
        </div>
    </div>
</div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
@endsection