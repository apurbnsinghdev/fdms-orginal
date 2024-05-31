@extends('layouts.default',['className' => 'fixed accounts forgot-password'])
@section('content')
    <div class="page-body  animated slideInDown">
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <!--LOGO-->
        <div class="logo">
            <img alt="logo" src="{{ asset('images/header-logo.png') }}" />
        </div>
        <div class="box">
            <!--FORGOT PASSWPRD FORM-->
            <div class="panel mb-none">
                <div class="panel-content bg-scale-0">
                    <form>
                        <h4>Forgot your password?</h4> Lorem ipsum dolor sit amet, consectetur adipisicing elit. A animi distinctio ducimus ipsam reprehenderit vel?
                        <div class="form-group mt-md">
                                <span class="input-with-icon">
                                        <input type="email" class="form-control" id="email" placeholder="Email">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block ">Send</button>
                        </div>
                        <div class="form-group text-center">
                            You remembered?, <a href="pages_sign-in">Sign in!</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    </div>
@endsection