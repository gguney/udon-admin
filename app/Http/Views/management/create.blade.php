@extends('layouts.app')

@section('content')
    <div class="w-form form-wrapper">

    <div class="w-form">
        <form class="w-clearfix form-div" role="form" method="POST" action="{{ url('/management') }}" enctype="multipart/form-data">
            <h3 class="heading">Create a Management</h3>
            {!! csrf_field() !!}
            <label for="owner" class="form-label">Owner</label>
            <select id="owner" name="owner" class="w-select select-field">
                @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->username }}</option>
                @endforeach
            </select>
            @if ($errors->has('owner'))
                <span class="help-block">
                    <strong>{{ $errors->first('owner') }}</strong>
                </span>
            @endif
            <label for="brand_name" class="form-label">Brand Name</label>
            <input id="brand_name" type="text" placeholder="Enter a brand name" name="brand_name" data-name="brand_name"
                   class="w-input text-field" value="{{ old('brand_name') }}">
            @if ($errors->has('brand_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('brand_name') }}</strong>
                </span>
            @endif
            <label for="company_name" class="form-label">Company Name</label>
            <input id="company_name" type="text" placeholder="Enter a company name" name="company_name" data-name="company_name"
                   class="w-input text-field" value="{{ old('company_name') }}">
            @if ($errors->has('company_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('company_name') }}</strong>
                </span>
            @endif
            <label for="tax_number" class="form-label">Tax Number</label>
            <input id="tax_number" type="text" placeholder="Enter a tax number" name="tax_number" data-name="tax_number"
                   class="w-input text-field" value="{{ old('tax_number') }}">
            @if ($errors->has('tax_number'))
                <span class="help-block">
                    <strong>{{ $errors->first('tax_number') }}</strong>
                </span>
            @endif
            <label for="image" class="form-label">Image</label>
            <input type="file"  class="w-input text-field" name="image">
            @if ($errors->has('file'))
                <span class="help-block">
                    <strong>{{ $errors->first('file') }}</strong>
                </span>
            @endif
            <a href="{{url('management')}}" class="w-button button-bad">CANCEL</a>
            <input type="submit" value="CREATE" data-wait="Please wait..." class="w-button button">
        </form>
    </div>
    </div>

@endsection

