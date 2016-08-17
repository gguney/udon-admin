@extends('layouts.app')

@section('content')
    <div class="w-form form-wrapper">

        {{ Form::model($country, array('route' => array('country.update', $country->id), 'method' => 'PUT')) }}
            <h3 class="heading">Edit Country</h3>
            {!! csrf_field() !!}

            <label for="name" class="form-label">Name</label>
            <input id="name" type="text" placeholder="Enter a country name" name="name" data-name="name"
                   class="w-input text-field" value="{{ $country->name }}">
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
            <label for="code" class="form-label">Code</label>
            <input id="code" type="text" placeholder="Enter a code" name="code" data-name="code"
                   class="w-input text-field" value="{{ $country->code }}">
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
            <label for="time_zone" class="form-label">Time Zone</label>
            <input id="time_zone" type="text" placeholder="Enter a time zone" name="time_zone" data-name="time_zone"
                   class="w-input text-field" value="{{ old('time_zone') }}">
            @if ($errors->has('time_zone'))
                <span class="help-block">
                        <strong>{{ $errors->first('time_zone') }}</strong>
                    </span>
            @endif


            <a href="{{url('country')}}" class="w-button button-bad">CANCEL</a>
            <input type="submit" value="EDIT" data-wait="Please wait..." class="w-button button">
        </form>
    </div>

@endsection

