@extends('layouts.login',['bodyClassName' => 'loging_body'])
@section('content')
<form method="POST" action="{{ route('password.request') }}">
    {{ csrf_field() }}

    <input type="hidden" name="token" value="{{ $token }}">

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
       <span class="input-with-icon">
            <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" placeholder="Email Address" required autofocus >
            <i class="fa fa-envelope"></i>
        </span>
         @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>

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

    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
        <span class="input-with-icon">
            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm Password" required>
            <i class="fa fa-key"></i>
        </span>
         @if ($errors->has('password_confirmation'))
            <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
        @endif
    </div>

    <div class="logbtn-wrap">
        <button type="submit" class="logBtn"> Reset Password</button>
    </div>
</form>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@stop
