@extends('layouts.app')

@section('content')
    <div class="w-form form-wrapper">

    <div class="w-form">
        <form class="w-clearfix form-div" role="form" method="POST" action="{{ url('/menu') }}">
            <h3 class="heading">Create a Menu</h3>
            {!! csrf_field() !!}
            <label for="management" class="form-label">Management</label>
            <select id="management" name="management" class="w-select select-field">
                @foreach($managements as $management)
                    <option value="{{$management->id}}">{{$management->company_name }}</option>
                @endforeach
            </select>
            @if ($errors->has('management'))
                <span class="help-block">
                    <strong>{{ $errors->first('management') }}</strong>
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
            <label for="description" class="form-label">Description</label>
            <input id="description" type="text" placeholder="Enter a description" name="description" data-name="description"
                   class="w-input text-field" value="{{ old('description') }}">
            @if ($errors->has('description'))
                <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif


            <a href="{{url('menu')}}" class="w-button button-bad">CANCEL</a>
            <input type="submit" value="CREATE" data-wait="Please wait..." class="w-button button">
        </form>
    </div>
    </div>

@endsection

