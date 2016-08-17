@extends('layouts.app')

@section('content')
    <div class="w-form form-wrapper">

    <div class="w-form">
        <form class="w-clearfix form-div" role="form" method="POST" action="{{ url('/user') }}">
            <h3 class="heading">Create a User</h3>
            {!! csrf_field() !!}
            {{--<label for="name" class="form-label">Category:</label>--}}
            {{--<select id="category_id" name="category_id" class="form-select-field">--}}
                {{--@foreach($htmlCategories as $htmlCategory)--}}
                    {{--<option value="{{$htmlCategory->id}}">{{$htmlCategory->name }}</option>--}}
                {{--@endforeach--}}
            {{--</select>--}}
            {{--@if ($errors->has('category_id'))--}}
                {{--<span class="help-block">--}}
                    {{--<strong>{{ $errors->first('category_id') }}</strong>--}}
                {{--</span>--}}
            {{--@endif--}}
            <label for="username" class="form-label">Username</label>
            <input id="username" type="text" placeholder="Enter a username" name="username" data-name="username"
                   class="w-input text-field" value="{{ old('username') }}">
            @if ($errors->has('username'))
                <span class="help-block">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
            @endif
            <label for="email" class="form-label">Email Address</label>
            <input id="email" type="email" placeholder="Enter an email" name="email" data-name="email"
                   class="w-input text-field" value="{{ old('email') }}">
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" placeholder="Enter a password" name="password" data-name="password"
                   class="w-input text-field" value="{{ old('password') }}">
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif


            <a href="{{url('user')}}" class="w-button button-bad">CANCEL</a>
            <input type="submit" value="CREATE" data-wait="Please wait..." class="w-button button">
        </form>
    </div>
    </div>

@endsection

