@extends('layouts.admin')
@section('content')
 <!-- ========================================================= -->
<div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-copy" aria-hidden="true"></i><a href="#">Pages</a></li>
            <li><a>User profile</a></li>
        </ul>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<div class="row">
    <div class="col-md-8 col-lg-8">
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <!--PROFILE-->
        <div>
            <div class="profile-photo">
                <img alt="User photo" src="{{ asset('storage/images/avatar/avatar_user.jpg') }}" />
            </div>
            <div class="user-header-info">
                <h2 class="user-name">Jane Doe</h2>
                <h5 class="user-position">UI Designer</h5>
                <div class="user-social-media">
                    <span class="text-lg"><a href="#" class="fa fa-twitter-square"></a> <a href="#" class="fa fa-facebook-square"></a> <a href="#" class="fa fa-linkedin-square"></a> <a href="#" class="fa fa-google-plus-square"></a></span>
                </div>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
         <!--CONTACT INFO-->
        <div class="panel bg-scale-0 b-primary bt-sm mt-xl">
            <div class="panel-content">
                <h4 class=""><b>Contact Information</b></h4>
                <ul class="user-contact-info ph-sm">
                    <li><b><i class="color-primary mr-sm fa fa-envelope"></i></b> jane-doe@email.com</li>
                    <li><b><i class="color-primary mr-sm fa fa-phone"></i></b> (023) 234 2344</li>
                    <li><b><i class="color-primary mr-sm fa fa-globe"></i></b> Helsinki, Finland</li>
                </ul>
            </div>
        </div>

         <!--About-->
        <div class="panel b-primary bt-sm mt-xl">
            <div class="panel-content">
                 <h4 class=""><b>About</b></h4>
                  <ul class="user-contact-info ph-sm">
                    <li class="mt-sm">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum dolorem error itaque maxime minus saepe similique voluptatibus. Beatae cumque dolore doloribus impedit omnis porro tempore tenetur. Aperiam dolorum odio quo?</li>
                </ul>
            </div>
        </div>
    </div>

</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
@endsection
@section('script')
<script>
    //MAGNIFIC POPUP GALLERY
    $(function() {
        $('.gallery-wrap').magnificPopup({
            delegate: 'a',
            type: 'image',
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [0, 1]
            },
            tLoading: 'Loading image #%curr%...',
            mainClass: 'mfp-no-margins mfp-with-zoom',
            zoom: {
                enabled: true,
                duration: 300
            }
        });
    });
</script>
@stop