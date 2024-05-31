@extends('layouts.admin')
@section('content')
<!-- ========================================================= -->
<div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">UI Elements</a></li>
            <li><a>Lightbox</a></li>
        </ul>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<div class="row animated fadeInUp">
    <!--MAGNIFIC POPUP-->
    <div class="col-sm-8 col-sm-offset-2">
        <h4 class="section-subtitle text-center"><b>Magnific Popup</b> -  Responsive lightbox</h4>
        <p class="section-text text-center mt-sm"><span class="highlight">Magnific Popup </span>is a responsive lightbox & dialog script with focus on performance and providing best experience for user with any device. For more <a href="http://dimsemenov.com/plugins/magnific-popup/">Info</a></p>
    </div>
    <!--SINGLE ITEM OPEN-->
    <div class="col-sm-12 col-md-6 mt-md">
        <div class="panel">
            <div class="panel-content">
                <h5><b>Single image</b> Lightbox</h5>
                <p>You can set diferents settings loremlike <span class="highlight">fit horizontally and vertically</span>  or  <span class="highlight">only  horizontally</span> </p>
                <div class="row">
                    <div class="col-xs-6 col-md-3">
                        <a href="{{ asset('storage/images/helsinki-lg.jpg') }}" title="By John Doe" class="image">
                            <img alt="first photo" src="{{ asset('storage/images/helsinki.jpg') }}" class="img-responsive mb-sm">
                        </a>
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <a href="{{ asset('storage/images/helsinki-lg.jpg') }}" title="By John Doe" class="image">
                            <img alt="second photo" src="{{ asset('storage/images/helsinki.jpg') }}" class="img-responsive mb-sm">
                        </a>
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <a href="{{ asset('storage/images/helsinki-lg.jpg') }}" title="By John Doe" class="image">
                            <img alt="third photo" src="{{ asset('storage/images/helsinki.jpg') }}" class="img-responsive mb-sm">
                        </a>
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <a href="{{ asset('storage/images/helsinki-lg.jpg') }}" title="By John Doe" class="image">
                            <img alt="fourth photo" src="{{ asset('storage/images/helsinki.jpg') }}" class="img-responsive mb-sm">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--MULTIPLES ITEMS OPEN-->
    <div class="col-sm-12 col-md-6 mt-md">
        <div class="panel">
            <div class="panel-content">
                <h5><b>Gallery</b> Lightbox</h5>
                <p>You can enable <span class="highlight">lazy-loading of images</span>  for the previous and next image based on move direction</p>
                <div class="row" id="gallery">
                    <div class="col-xs-6 col-md-3">
                        <a href="{{ asset('storage/images/helsinki-lg.jpg') }}" title="By John Doe">
                            <img alt="first photo" src="{{ asset('storage/images/helsinki.jpg') }}" class="img-responsive mb-sm">
                        </a>
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <a href="{{ asset('storage/images/helsinki-lg.jpg') }}" title="By John Doe">
                            <img alt="second photo" src="{{ asset('storage/images/helsinki.jpg') }}" class="img-responsive mb-sm">
                        </a>
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <a href="{{ asset('storage/images/helsinki-lg.jpg') }}" title="By John Doe">
                            <img alt="third photo" src="{{ asset('storage/images/helsinki.jpg') }}" class="img-responsive mb-sm">
                        </a>
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <a href="{{ asset('storage/images/helsinki-lg.jpg') }}" title="By John Doe">
                            <img alt="fourth photo" src="{{ asset('storage/images/helsinki.jpg') }}" class="img-responsive mb-sm">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--ZOOM EFFECT-->
    <div class="col-sm-12 col-md-6  mt-md">
        <div class="panel">
            <div class="panel-content">
                <h5><b>Zoom effect</b> </h5>
                <p>It can be added a <span class="highlight">zooming effect</span> </p>
                <div class="row" id="gallery-with-zoom">
                    <div class="col-xs-6 col-md-3">
                        <a href="{{ asset('storage/images/helsinki-lg.jpg') }}" title="By John Doe">
                            <img alt="first photo" src="{{ asset('storage/images/helsinki.jpg') }}" class="img-responsive mb-sm">
                        </a>
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <a href="{{ asset('storage/images/helsinki-lg.jpg') }}" title="By John Doe">
                            <img alt="second photo" src="{{ asset('storage/images/helsinki.jpg') }}" class="img-responsive mb-sm">
                        </a>
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <a href="{{ asset('storage/images/helsinki-lg.jpg') }}" title="By John Doe">
                            <img alt="third photo" src="{{ asset('storage/images/helsinki.jpg') }}" class="img-responsive mb-sm">
                        </a>
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <a href="{{ asset('storage/images/helsinki-lg.jpg') }}" title="By John Doe">
                            <img alt="fourth photo" src="{{ asset('storage/images/helsinki.jpg') }}" class="img-responsive mb-sm">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--ZOOM EFFECT-->
    <div class="col-sm-12 col-md-6  mt-md">
        <div class="panel">
            <div class="panel-content">
                <h5><b>Video or map</b> lightbox</h5>
                <a class="btn btn-primary popup-youtube" href="http://www.youtube.com/watch?v=6NC_ODHu5jg">YouTube video</a>
                <a class="btn btn-primary popup-vimeo" href="https://vimeo.com/158050352">Vimeo video</a>
                <a class="btn btn-primary popup-gmaps" href="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d254083.63470273896!2d24.76009565589652!3d60.16370876542306!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46920bc796210691%3A0xcd4ebd843be2f763!2sHelsinki%2C+Finlandia!5e0!3m2!1ses!2ses!4v1480450323000">Google Map</a>
            </div>
        </div>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
@endsection
@section('script')
    <!--Examples-->
    <script src="{{ asset('vendor/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/examples/ui-elements/lightbox.js') }}"></script>
@stop

