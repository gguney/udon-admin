@extends('layouts.app')

@section('content')
    <div class="w-form form-wrapper">

    <div class="w-form">
        <form class="w-clearfix form-div" role="form" method="POST" action="{{ url('/region') }}">
            <h3 class="heading">Create a Region</h3>
            {!! csrf_field() !!}
            <label for="city" class="form-label">City</label>
            <select id="city" name="city" class="w-select select-field">
                @foreach($cities as $city)
                    <option value="{{$city->id}}">{{$city->name }}</option>
                @endforeach
            </select>
            @if ($errors->has('city'))
                <span class="help-block">
                    <strong>{{ $errors->first('city') }}</strong>
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
            <label for="postal_code" class="form-label">Postal Code</label>
            <input id="postal_code" type="text" placeholder="Enter a postal code" name="postal_code" data-name="postal_code"
                   class="w-input text-field" value="{{ old('postal_code') }}">
            @if ($errors->has('postal_code'))
                <span class="help-block">
                    <strong>{{ $errors->first('postal_code') }}</strong>
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


            <a href="{{url('region')}}" class="w-button button-bad">CANCEL</a>
            <input type="submit" value="CREATE" data-wait="Please wait..." class="w-button button">
        </form>
    </div>
    </div>

@endsection

