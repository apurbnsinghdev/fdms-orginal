@extends('layouts.login',['bodyClassName' => 'loging_body'])
@section('content')
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<form method="POST" action="{{ route('password.email') }}">
     {{ csrf_field() }}
    <h4>Forgot your password?</h4> To reset your password, enter your email below. If you forgot your email, you will need to contact with Technical Support.
    <div class="form-group mt-md{{ $errors->has('email') ? ' has-error' : '' }}">
            <span class="input-with-icon">
                <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{ old('email') }}" required>
                <i class="fa fa-envelope"></i>
            </span>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
    </div>
    <div class="logbtn-wrap">
        <button type="submit" class="logBtn"> Send Reset Link</button>
        @if (Route::has('login'))<a href="{{ url('/login') }}">Sign in?</a>@endif
    </div>
</form>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@stop