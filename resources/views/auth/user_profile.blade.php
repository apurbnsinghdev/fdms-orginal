@extends('layouts.admin')
@section('content')
 <!-- ========================================================= -->
<div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-copy" aria-hidden="true"></i><a href="#">User</a></li>
            <li><a>Profile</a></li>
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
            	{{ Form::model(request()->old(),array('route' => array('ajax.uploadProfilePicture'),'enctype'=>'multipart/form-data','id'=>'uploadProfilePicture')) }}
                <input type="file" name="avatar" id="profile-picture" accept="image/*"/>
                {{ Form::close() }}
                @if(auth()->user()->avatar)
                	<img alt="User photo" src="{{ asset('storage/images/avatar/'.auth()->user()->avatar) }}" />
                @else
                	<img alt="profile photo" src="{{ asset('storage/images/avatar/avatar_user.jpg') }}" />
                @endif
                {!! $errors->first('avatar', '<p class="text-danger">:message</p>' ) !!}
            </div>

            <div class="user-header-info">
                <h2 class="user-name">{{ $user->name }}</h2>
                <h5 class="user-position">{{ $user->designation->title or '' }} ({{ $user->designation->short_name or '' }})</h5>
                {{-- <div class="user-social-media">
                    <span class="text-lg"><a href="#" class="fa fa-twitter-square"></a> <a href="#" class="fa fa-facebook-square"></a> <a href="#" class="fa fa-linkedin-square"></a> <a href="#" class="fa fa-google-plus-square"></a></span>
                </div> --}}
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
         <!--CONTACT INFO-->
        <div class="panel bg-scale-0 b-primary bt-sm mt-xl">
            <div class="panel-content">
                <h4> <b>Contact Information</b></h4>
                <ul class="user-contact-info ph-sm">
                    <li><b><i class="color-primary mr-sm fa fa-envelope"></i></b>{{ $user->email }}</li>
                    <li><b><i class="color-primary mr-sm fa fa-phone"></i></b> {{ $user->mobile }}</li>
                   {{--  <li><b><i class="color-primary mr-sm fa fa-globe"></i></b> Helsinki, Finland</li> --}}
                </ul>
            </div>
        </div>

         <!--About-->
        <div class="panel b-primary bt-sm mt-xl">
            <div class="panel-content">
                 <h4 class=""><b>About</b></h4>
                  <ul class="user-contact-info ph-sm">
                    <li class="mt-sm"><strong>Role: </strong><span class="text-danger">{{ $user->role->name }}</span></li>
                    <li class="mt-sm">
                        <strong>Assign Depot: </strong>
                        <ul class="row">
                            @foreach ($depots as $ele)
                                <li class="col-md-4">{{ $ele }}</li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
@endsection
@section('css')
<style>
.profile-photo{
    position:relative;
}
.profile-photo input[type=file] {
  position:absolute;
  left:0;
  top:0;
  width:100%;
  height:100%;
  opacity: 0;
  cursor:pointer;
}

</style>
@endsection
@section('script')
<script>
$("#profile-picture").change(function() {
	var file = document.getElementById("profile-picture").value;
	var fileExtension = file.split('.').pop().toLowerCase();
	if(fileExtension == 'jpeg' || fileExtension == 'jpg' || fileExtension == 'png'){
		document.getElementById("uploadProfilePicture").submit();
	}
	
});
</script>
@stop