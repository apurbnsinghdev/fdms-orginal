 <!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="authors" content="mipellim,abdulbaten1983@gmail.com">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ $site_settings->site_title or 'Dhaka Ice Cream Industries Ltd.' }}</title>
    @include('common_pages.favicon')
    <!--BASIC css-->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/font-awesome.css') }}">
     @yield('css')
    <script>
        var laravelObj={};
        laravelObj.appHost='{{ url('/') }}';
        window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token()]); ?>
    </script>
    <style type="text/css" media="screen">
        .design-develop{
            padding: 0;
            margin: 0;
            color: #fff;
            position: absolute;
            right:15px;
            bottom: 20px;
        }
        .design-develop a{
            color: #fff;
            font-weight: bold;
        }
    </style>
</head>

<body class="{{$bodyClassName or ''}}">
    <div class="img-bg" id="app">
        <div class="left-img">
            <img src="{{ asset('storage/images/item-1.png')}}" alt="">
        </div>
        <div class="right-img">
            <img src="{{ asset('storage/images/item-2.png')}}" alt="">
        </div>
        <div class="login-box">
            <div class="logo">
                <a href="#">
                    @if(!empty($site_settings->logo))
                        @if(file_exists('storage/images/'.$site_settings->logo))
                            <img alt="logo" class="" src="{{ asset('storage/images/'.$site_settings->logo) }}" />
                        @else
                            <img alt="logo" class="" src="{{ asset('storage/images/header-logo.png') }}" />
                        @endif
                    @else
                        <img alt="logo" class="" src="{{ asset('storage/images/header-logo.png') }}" />
                    @endif
                </a>
            </div>
            <div class="admin-form">
                @yield('content')
            </div>
        </div>
        @include('common_pages.design_and_develop')
    </div>

    <!--BASIC scripts-->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- SECTION script and examples-->
     @yield('script')
</body>
</html>