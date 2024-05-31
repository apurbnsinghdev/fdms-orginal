@extends('layouts.admin')
@section('content')
<div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-copy" aria-hidden="true"></i><a href="#">Pages</a></li>
            <li><a>Error 404</a></li>
        </ul>
    </div>
</div>
<!--ERROR 404 IN CONTENT-->
<div class="row animated bounce">
    <div class="col-sm-8 col-sm-offset-2">
        <div class="panel mt-xlg">
            <div class="panel-content">
                <h1 class="error-number">404</h1>
                <h2 class="error-name"> Page not found</h2>
                <p class="error-text">Sorry, the page you are looking for cannot be found.
                    <br/>Please check the url for errors or try one of the options below</p>
                <div class="row mt-lg">
                    <div class="col-sm-6  col-sm-offset-3">
                        <button class="btn btn-sm btn-darker-2 btn-block" onclick="history.back();">Previous page</button>
                        <a href="index.html" class="btn btn-sm btn-primary btn-block">Dashboard</a>
                        <a href="pages_faq.html" class="btn btn-sm btn-lighter-2 btn-block mb-lg">FAQ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
