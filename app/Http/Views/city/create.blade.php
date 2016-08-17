@extends('layouts.app')

@section('content')
    <div class="w-form form-wrapper">

    <div class="w-form">
        <form class="w-clearfix form-div" role="form" method="POST" action="{{ url('/city') }}">
            <h3 class="heading">Create a City</h3>
            {!! csrf_field() !!}
            <label for="country" class="form-label">Country</label>
            <select id="country" name="country" class="w-select select-field">
                @foreach($countries as $country)
                    <option value="{{$country->id}}">{{$country->name }}</option>
                @endforeach
            </select>
            @if ($errors->has('country'))
                <span class="help-block">
                    <strong>{{ $errors->first('country') }}</strong>
                </span>
            @endif
            <label for="name" class="form-label">Name</label>
            <input id="name" type="text" placeholder="Enter a name" name="name" data-name="name"
                   class="w-input text-field" value="{{ old('name') }}">
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
            <label for="code" class="form-label">Code</label>
            <input id="code" type="text" placeholder="Enter a code" name="code" data-name="code"
                   class="w-input text-field" value="{{ old('code') }}">
            @if ($errors->has('code'))
                <span class="help-block">
                    <strong>{{ $errors->first('code') }}</strong>
                </span>
            @endif
            <label for="description" class="form-label">Description</label>
            <input id="description" type="text" placeholder="Enter a description" name="description" data-name="description"
                   class="w-input text-field" value="{{ old('description') }}">
            @if ($errors->has('description'))
                <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif


            <a href="{{url('city')}}" class="w-button button-bad">CANCEL</a>
            <input type="submit" value="CREATE" data-wait="Please wait..." class="w-button button">
        </form>
    </div>
    </div>

@endsection

