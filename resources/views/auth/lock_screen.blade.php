@extends('layouts.default',['className' => 'fixed accounts lock-screen'])
@section('content')
    <div class="page-body">
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <!--LOGO-->
        <div class="logo">
            <div class="avatar">
                <img alt="User photo" src="{{ asset('storage/images/avatar/avatar_user.jpg') }}" />
            </div>
        </div>
        <div class="box animated fadeInUp">
            <!--UNLOCK FORM-->
            <div class="panel">
                <div class="panel-content bg-scale-0">
                    <form>
                        <h3 class="text-center mb-md">Jane Doe</h3>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <span class="input-with-icon">
                                <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                                <i class="fa fa-key"></i>
                            </span>
                             @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <a href="{{ route('dashboard') }}" class="btn btn-primary btn-block ">Unlock</a>
                        </div>
                        <div class="form-group text-center">
                            <a href="{{ route('login') }}">Not Jane Doe?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    </div>
@endsection
