@extends('layouts.app')

@section('content')
    <div class="w-form form-wrapper">

        {{ Form::model($user, array('route' => array('user.update', $user->id), 'method' => 'PUT')) }}
            <h3 class="heading">Edit User</h3>
            {!! csrf_field() !!}

            <label for="username" class="form-label">Username</label>
            <input id="username" type="text" placeholder="Enter a username" name="username" data-name="username"
                   class="w-input text-field" value="{{ $user->username }}">
            @if ($errors->has('username'))
                <span class="help-block">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
            @endif
            <label for="email" class="form-label">Email Address</label>
            <input id="email" type="email" placeholder="Enter an email" name="email" data-name="email"
                   class="w-input text-field" value="{{$user->email}}">
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        <h4 class="form-mid-heading">Roles</h4>
        <div class="w-clearfix form-mid-div">
            @foreach($roles as $role)

            <div class="w-checkbox checbox-field">
                @if(in_array($role->id,$usersRoles))
                    <input id="roles" type="checkbox" name="roles[]" value="{{$role->id}}" class="w-checkbox-input" checked="checked">
                @else
                    <input id="roles" type="checkbox" name="roles[]" value="{{$role->id}}" class="w-checkbox-input">
                @endif

                <label for="roles" class="w-form-label">{{$role->name}}</label>
            </div>
            @endforeach
        </div>

            {{--<label for="password" class="form-label">Password</label>--}}
            {{--<input id="password" type="password" placeholder="Enter a password" name="password" data-name="password"--}}
                   {{--class="w-input text-field" value="{{ $user->password }}">--}}
            {{--@if ($errors->has('password'))--}}
                {{--<span class="help-block">--}}
                    {{--<strong>{{ $errors->first('password') }}</strong>--}}
                {{--</span>--}}
            {{--@endif--}}


            <a href="{{url('user')}}" class="w-button button-bad">CANCEL</a>
            <input type="submit" value="EDIT" data-wait="Please wait..." class="w-button button">
        </form>
    </div>

@endsection

