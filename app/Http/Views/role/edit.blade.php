@extends('layouts.app')

@section('content')
    <div class="w-form form-wrapper">

        {{ Form::model($role, array('route' => array('role.update', $role->id), 'method' => 'PUT')) }}
        <h3 class="heading">Edit Role</h3>
        {!! csrf_field() !!}

            <label for="name" class="form-label">Name</label>
            <input id="name" type="text" placeholder="Enter a role name" name="name" data-name="name"
                   class="w-input text-field" value="{{ $role->name }}">
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
            <label for="description" class="form-label">Description</label>
            <input id="description" type="text" placeholder="Enter a description" name="description" data-name="description"
                   class="w-input text-field" value="{{ $role->description }}">
            @if ($errors->has('description'))
                <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
            @endif


            {{--<label for="password" class="form-label">Password</label>--}}
            {{--<input id="password" type="password" placeholder="Enter a password" name="password" data-name="password"--}}
                   {{--class="w-input text-field" value="{{ $user->password }}">--}}
            {{--@if ($errors->has('password'))--}}
                {{--<span class="help-block">--}}
                    {{--<strong>{{ $errors->first('password') }}</strong>--}}
                {{--</span>--}}
            {{--@endif--}}


            <a href="{{url('role')}}" class="w-button button-bad">CANCEL</a>
            <input type="submit" value="EDIT" data-wait="Please wait..." class="w-button button">
        </form>
    </div>

@endsection

