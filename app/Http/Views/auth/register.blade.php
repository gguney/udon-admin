@extends('layouts.app')

@section('content')

    <div class="w-form form-wrapper">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
            <h2 class="heading">Register</h2>
            {!! csrf_field() !!}
            <label class="form-label">Username</label>
            <input type="text" class="w-input text-field" name="username" value="{{ old('username') }}">

            @if ($errors->has('username'))
                <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
            @endif
            <label class="form-label">Email Address</label>
            <input type="email" class="w-input text-field" name="email" value="{{ old('email') }}">

            @if ($errors->has('email'))
                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
            @endif
            <label class="form-label">Password</label>
            <input type="password" class="w-input text-field" name="password" value="{{ old('password') }}">

            @if ($errors->has('password'))
                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
            @endif

            <label class="form-label">Confirm Password</label>
            <input type="password" class="w-input text-field" name="password_confirmation" value="{{ old('password_confirmation') }}">

            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
            @endif
            <a class="w-button button-bad">CANCEL</a>
            <input type="submit" value="SUBMIT"  class="w-button button">

        </form>
    </div>
@endsection
