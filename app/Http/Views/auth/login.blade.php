@extends('layouts.app')

@section('content')

    <div class="w-form form-wrapper">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
            <h2 class="heading">Login</h2>
            {!! csrf_field() !!}
                <label class="form-label">Username</label>
                    <input type="text" class="w-input text-field" name="username" value="{{ old('username') }}">

                    @if ($errors->has('username'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                    @endif
            <label class="form-label">Password</label>
            <input type="password" class="w-input text-field" name="password" value="{{ old('password') }}">

            @if ($errors->has('password'))
                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
            @endif


            <a class="" href="{{ url('/password/reset') }}">Forgot Your Password?</a>

            <div class="w-checkbox w-clearfix checbox-field">
                <input id="remember" type="checkbox" name="remember" data-name="Checkbox" class="w-checkbox-input">
                <label for="remember" class="w-form-label">Remember Me</label>
            </div>
            <a class="w-button button-bad">CANCEL</a>
            <input type="submit" value="SUBMIT"  class="w-button button">

        </form>
    </div>
@endsection
