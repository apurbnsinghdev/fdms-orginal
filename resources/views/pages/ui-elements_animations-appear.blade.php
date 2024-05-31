@extends('layouts.admin')
@section('content')
<!-- ========================================================= -->
<div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">UI Elements</a></li>
            <li><a>Animations</a></li>
        </ul>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<div class="animated fadeInUp">
    <!--ANIMATION WITH CSS-->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="section-subtitle text-center"><b>Animate.css</b> - Animations with just css!</h4>
        </div>
        <div class="col-sm-8 col-sm-offset-2">
            <p class="section-text text-center mt-sm"> To animate elements that will be always visible (body, containers, contents) or that will be be trigger, just add the <span class="highlight">class</span> <span class="code">animated</span> and the <span class="highlight">class</span> <span class="code">[animation-name]</span> to the element you want to animate. For more <a href="https://daneden.github.io/animate.css/">Info</a></p>

        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--EFFECTS ANIMATION-->
    <div class="row mt-xl">
        <div class="col-sm-2">
            <img alt="animation image" id="img-1" class="img-animated" src="{{ asset('storage/images/helsinki.jpg') }}" />
        </div>
        <div class="col-sm-10">
            <h4 class="section-subtitle"><b>Effects</b> Animation</h4>
            <div class="panel">
                <div class="panel-content">
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-1" data-animated-class="bounce">bounce</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-1" data-animated-class="flash">flash</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-1" data-animated-class="pulse">pulse</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-1" data-animated-class="rubberBand">rubberBand</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-1" data-animated-class="shake">shake</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-1" data-animated-class="headShake">headShake</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-1" data-animated-class="swing">swing</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-1" data-animated-class="tada">tada</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-1" data-animated-class="wobble">wobble</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-1" data-animated-class="jello">jello</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-1" data-animated-class="hinge">hinge</button>
                </div>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <div class="row mt-xl">
        <div class="col-sm-2 col-sm-push-10">
            <img alt="animation image" id="img-2" class="img-animated" src="{{ asset('storage/images/helsinki.jpg') }}" />
        </div>
        <div class="col-sm-5 col-sm-pull-2">
            <h4 class="section-subtitle"><b>Bounce In</b> Animation</h4>
            <div class="panel">
                <div class="panel-content">
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-2" data-animated-class="bounceIn">bounceIn</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-2" data-animated-class="bounceInDown">bounceInDown</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-2" data-animated-class="bounceInLeft">bounceInLeft</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-2" data-animated-class="bounceInRight">bounceInRight</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-2" data-animated-class="bounceInUp">bounceInUp</button>
                </div>
            </div>
        </div>
        <div class="col-sm-5 col-sm-pull-2">
            <h4 class="section-subtitle"><b>Bounce Out</b> Animation</h4>
            <div class="panel">
                <div class="panel-content">
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-2" data-animated-class="bounceOut">bounceOut</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-2" data-animated-class="bounceOutDown">bounceOutDown</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-2" data-animated-class="bounceOutLeft">bounceOutLeft</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-2" data-animated-class="bounceOutRight">bounceOutRight</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-2" data-animated-class="bounceOutUp">bounceOutUp</button>
                </div>
            </div>
        </div>

    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <div class="row mt-xl">
        <div class="col-sm-2">
            <img alt="animation image" id="img-3" class="img-animated" src="{{ asset('storage/images/helsinki.jpg') }}" />
        </div>
        <div class="col-sm-5">
            <h4 class="section-subtitle"><b>Fade In</b> Animation</h4>
            <div class="panel">
                <div class="panel-content">
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-3" data-animated-class="fadeIn">fadeIn</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-3" data-animated-class="fadeInDown">fadeInDown</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-3" data-animated-class="fadeInDownBig">fadeInDownBig</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-3" data-animated-class="fadeInLeft">fadeInLeft</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-3" data-animated-class="fadeInLeftBig">fadeInLeftBig</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-3" data-animated-class="fadeInRight">fadeInRight</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-3" data-animated-class="fadeInRightBig">fadeInRightBig</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-3" data-animated-class="fadeInUp">fadeInUp</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-3" data-animated-class="fadeInUpBig">fadeInUpBig</button>
                </div>
            </div>
        </div>
        <div class="col-sm-5">
            <h4 class="section-subtitle"><b>Fade Out</b> Animation</h4>
            <div class="panel">
                <div class="panel-content">
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-3" data-animated-class="fadeOut">fadeOut</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-3" data-animated-class="fadeOutDown">fadeOutDown</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-3" data-animated-class="fadeOutDownBig">fadeOutDownBig</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-3" data-animated-class="fadeOutLeft">fadeOutLeft</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-3" data-animated-class="fadeOutLeftBig">fadeOutLeftBig</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-3" data-animated-class="fadeOutRight">fadeOutRight</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-3" data-animated-class="fadeOutRightBig">fadeOutRightBig</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-3" data-animated-class="fadeOutUp">fadeOutUp</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-3" data-animated-class="fadeOutUpBig">fadeOutUpBig</button>
                </div>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <div class="row mt-xl">
        <div class="col-sm-2 col-sm-push-10">
            <img alt="animation image" id="img-4" class="img-animated" src="{{ asset('storage/images/helsinki.jpg') }}" />
        </div>
        <div class="col-sm-5 col-sm-pull-2">
            <h4 class="section-subtitle"><b>Rotate In</b> Animation</h4>
            <div class="panel">
                <div class="panel-content">
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-4" data-animated-class="rotateIn">rotateIn</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-4" data-animated-class="rotateInDownLeft">rotateInDownLeft</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-4" data-animated-class="rotateInDownRight">rotateInDownRight</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-4" data-animated-class="rotateInUpLeft">rotateInUpLeft</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-4" data-animated-class="rotateInUpRight">rotateInUpRight</button>
                </div>
            </div>
        </div>
        <div class="col-sm-5 col-sm-pull-2">
            <h4 class="section-subtitle"><b>Rotate Out</b> Animation</h4>
            <div class="panel">
                <div class="panel-content">
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-4" data-animated-class="rotateOut">rotateOut</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-4" data-animated-class="rotateOutDownLeft">rotateOutDownLeft</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-4" data-animated-class="rotateOutDownRight">rotateOutDownRight</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-4" data-animated-class="rotateOutUpLeft">rotateOutUpLeft</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-4" data-animated-class="rotateOutUpRight">rotateOutUpRight</button>
                </div>
            </div>
        </div>

    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <div class="row mt-xl">
        <div class="col-sm-2">
            <img alt="animation image" id="img-5" class="img-animated" src="{{ asset('storage/images/helsinki.jpg') }}" />
        </div>
        <div class="col-sm-5">
            <h4 class="section-subtitle"><b>Zoom In</b> Animation</h4>
            <div class="panel">
                <div class="panel-content">
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-5" data-animated-class="zoomIn">zoomIn</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-5" data-animated-class="zoomInDown">zoomInDown</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-5" data-animated-class="zoomInLeft">zoomInLeft</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-5" data-animated-class="zoomInRight">zoomInRight</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-5" data-animated-class="zoomInUp">zoomInUp</button>
                </div>
            </div>
        </div>
        <div class="col-sm-5">
            <h4 class="section-subtitle"><b>Zoom Out</b> Animation</h4>
            <div class="panel">
                <div class="panel-content">
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-5" data-animated-class="zoomOut">zoomOut</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-5" data-animated-class="zoomOutDown">zoomOutDown</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-5" data-animated-class="zoomOutLeft">zoomOutLeft</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-5" data-animated-class="zoomOutRight">zoomOutRight</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-5" data-animated-class="zoomOutUp">zoomOutUp</button>
                </div>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <div class="row mt-xl">
        <div class="col-sm-2 col-sm-push-10">
            <img alt="animation image" id="img-6" class="img-animated" src="{{ asset('storage/images/helsinki.jpg') }}" />
        </div>
        <div class="col-sm-5 col-sm-pull-2">
            <h4 class="section-subtitle"><b>Slide In</b> Animation</h4>
            <div class="panel">
                <div class="panel-content">
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-6" data-animated-class="slideInDown">slideInDown</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-6" data-animated-class="slideInLeft">slideInLeft</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-6" data-animated-class="slideInRight">slideInRight</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-6" data-animated-class="slideInUp">slideInUp</button>
                </div>
            </div>
        </div>
        <div class="col-sm-5 col-sm-pull-2">
            <h4 class="section-subtitle"><b>Slide Out</b> Animation</h4>
            <div class="panel">
                <div class="panel-content">
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-6" data-animated-class="slideOutDown">slideOutDown</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-6" data-animated-class="slideOutLeft">slideOutLeft</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-6" data-animated-class="slideOutRight">slideOutRight</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-6" data-animated-class="slideOutUp">slideOutUp</button>
                </div>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <div class="row mt-xl">
        <div class="col-sm-2">
            <img alt="animation image" id="img-7" class="img-animated" src="{{ asset('storage/images/helsinki.jpg') }}" />
        </div>
        <div class="col-sm-4">
            <h4 class="section-subtitle"><b>Flip In & Out</b> Animation</h4>
            <div class="panel">
                <div class="panel-content">
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-7" data-animated-class="flipInX">flipInX</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-7" data-animated-class="flipInY">flipInY</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-7" data-animated-class="flipOutX">flipOutX</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-7" data-animated-class="flipOutY">flipOutY</button>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <h4 class="section-subtitle"><b>LightSpeed In & Out</b> Animation</h4>
            <div class="panel">
                <div class="panel-content">
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-7" data-animated-class="lightSpeedIn">lightSpeedIn</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-7" data-animated-class="lightSpeedOut">lightSpeedOut</button>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <h4 class="section-subtitle"><b>Roll In & Out</b> Animation</h4>
            <div class="panel">
                <div class="panel-content">
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-7" data-animated-class="rollIn">rollIn</button>
                    <button class="btn btn-o btn-primary btn-xs btn-animated mb-xs" data-img="img-7" data-animated-class="rollOut">rollOut</button>
                </div>
            </div>
        </div>
    </div>

    <!--ANIMATION WITH JS-->
    <div class="row">
        <div class="col-sm-12">
            <hr/>
            <h4 class="section-subtitle text-center pt-xl"><b>Animate.css</b> and <b>jQuery plugin appears</b></h4>
        </div>

        <div class="col-sm-8 col-sm-offset-2">
            <p class="section-text text-center mt-sm"> To animate elements when they appear in to the view, add the <span class="highlight">property</span> <span class="code">data-animation-name="[animation-name]"</span> to the element you want to animate. For more <a href="https://github.com/bas2k/jquery.appear/">Info</a></p>
            <h4 class="text-center">You can use <span class="highlight">all the effects</span> shown above</h4>
        </div>
    </div>

    <div class="row mt-xl">
        <div class="col-sm-2">
            <h5 class="highlight text-center">wobble</h5>
            <img data-animation-name="wobble" alt="animation image"  class="img-animated" src="{{ asset('storage/images/helsinki.jpg') }}" />
        </div>
        <div class="col-sm-2">
            <h5 class="highlight text-center">bounce</h5>
            <img data-animation-name="bounce" alt="animation image"  class="img-animated" src="{{ asset('storage/images/helsinki.jpg') }}" />
        </div>
        <div class="col-sm-2">
            <h5 class="highlight text-center">flash</h5>
            <img data-animation-name="flash" alt="animation image"  class="img-animated" src="{{ asset('storage/images/helsinki.jpg') }}" />
        </div>
        <div class="col-sm-2">
            <h5 class="highlight text-center">pulse</h5>
            <img data-animation-name="pulse" alt="animation image"  class="img-animated" src="{{ asset('storage/images/helsinki.jpg') }}" />
        </div>
        <div class="col-sm-2">
            <h5 class="highlight text-center">shake</h5>
            <img data-animation-name="shake" alt="animation image"  class="img-animated" src="{{ asset('storage/images/helsinki.jpg') }}" />
        </div>
        <div class="col-sm-2">
            <h5 class="highlight text-center">tada</h5>
            <img data-animation-name="tada" alt="animation image"  class="img-animated" src="{{ asset('storage/images/helsinki.jpg') }}" />
        </div>
    </div>
    <div class="row mt-xl">
        <div class="col-sm-2">
            <h5 class="highlight text-center">bouceIn</h5>
            <img data-animation-name="bouceIn" alt="animation image"  class="img-animated" src="{{ asset('storage/images/helsinki.jpg') }}" />
        </div>
        <div class="col-sm-2">
            <h5 class="highlight text-center">bounceInLeft</h5>
            <img data-animation-name="bounceInLeft" alt="animation image"  class="img-animated" src="{{ asset('storage/images/helsinki.jpg') }}" />
        </div>
        <div class="col-sm-2">
            <h5 class="highlight text-center">bounceInRight</h5>
            <img data-animation-name="bounceInRight" alt="animation image"  class="img-animated" src="{{ asset('storage/images/helsinki.jpg') }}" />
        </div>
        <div class="col-sm-2">
            <h5 class="highlight text-center">bounceInDown</h5>
            <img data-animation-name="bounceInDown" alt="animation image"  class="img-animated" src="{{ asset('storage/images/helsinki.jpg') }}" />
        </div>
        <div class="col-sm-2">
            <h5 class="highlight text-center">bounceInUp</h5>
            <img data-animation-name="bounceInUp" alt="animation image"  class="img-animated" src="{{ asset('storage/images/helsinki.jpg') }}" />
        </div>
        <div class="col-sm-2">
            <h5 class="highlight text-center">bounceInRight</h5>
            <img data-animation-name="bounceInRight" alt="animation image"  class="img-animated" src="{{ asset('storage/images/helsinki.jpg') }}" />
        </div>
    </div>
    <div class="row mt-xl">
        <div class="col-sm-2">
            <h5 class="highlight text-center">bouceIn</h5>
            <img data-animation-name="bouceIn" alt="animation image"  class="img-animated" src="{{ asset('storage/images/helsinki.jpg') }}" />
        </div>
        <div class="col-sm-2">
            <h5 class="highlight text-center">fadeInLeft</h5>
            <img data-animation-name="fadeInLeft" alt="animation image"  class="img-animated" src="{{ asset('storage/images/helsinki.jpg') }}" />
        </div>
        <div class="col-sm-2">
            <h5 class="highlight text-center">fadeInRight</h5>
            <img data-animation-name="fadeInRight" alt="animation image"  class="img-animated" src="{{ asset('storage/images/helsinki.jpg') }}" />
        </div>
        <div class="col-sm-2">
            <h5 class="highlight text-center">fadeInDown</h5>
            <img data-animation-name="fadeInDown" alt="animation image"  class="img-animated" src="{{ asset('storage/images/helsinki.jpg') }}" />
        </div>
        <div class="col-sm-2">
            <h5 class="highlight text-center">fadeInUp</h5>
            <img data-animation-name="fadeInUp" alt="animation image"  class="img-animated" src="{{ asset('storage/images/helsinki.jpg') }}" />
        </div>
        <div class="col-sm-2">
            <h5 class="highlight text-center">fadeInRight</h5>
            <img data-animation-name="fadeInRight" alt="animation image"  class="img-animated" src="{{ asset('storage/images/helsinki.jpg') }}" />
        </div>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
@endsection
@section('script')
<!--appear-->
<script src="{{ asset('vendor/jquery.appear/jquery.appear.min.js') }}"></script>
<script>
    $.fn.extend({
        animateCss: function(animationName) {
            var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
            this.addClass('animated ' + animationName).one(animationEnd, function() {
                $(this).removeClass('animated ' + animationName);
            });
        }
    });

    $(".btn-animated").on('click', function() {
        var animation = $(this).attr('data-animated-class');
        var img = $(this).attr('data-img');
        $("#" + img).animateCss(animation);
    });
</script>
@stop
