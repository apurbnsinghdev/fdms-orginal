<!doctype html>
<html lang="en" class="{{$className or 'error-404'}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ $site_settings->site_title or 'Dhaka Ice Cream Industries Ltd.' }}</title>
    @include('common_pages.favicon')
    <!--BASIC css-->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script>
        var laravelObj={};
        laravelObj.appHost='{{ url('/') }}';
        window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token()]); ?>
    </script>
</head>

<body>
    <div class="wrap" id="app">
        <div class="page-body">
            @yield('content')
        </div>
    </div>
    <!--BASIC scripts-->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>