@extends('layouts.app')

@section('content')
    <div class="w-form form-wrapper">

    <div class="w-form">
        <form class="w-clearfix form-div" role="form" method="POST" action="{{ url('/food') }}" enctype="multipart/form-data">
            <h3 class="heading">Create a Food</h3>
            {!! csrf_field() !!}
            <label for="category" class="form-label">Category</label>
            <select id="category" name="category" class="w-select select-field">
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name }}</option>
                @endforeach
            </select>
            @if ($errors->has('category'))
                <span class="help-block">
                    <strong>{{ $errors->first('category') }}</strong>
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
            <label for="image" class="form-label">Image</label>
            <input type="file"  class="w-input text-field" name="image">
            @if ($errors->has('file'))
                <span class="help-block">
                    <strong>{{ $errors->first('file') }}</strong>
                </span>
            @endif
            <h4 class="form-mid-heading">Ingredients</h4>
            <div class="w-clearfix form-mid-div">
                @foreach($ingredients as $ingredient)
                    <div class="w-checkbox checbox-field">
                        <input id="ingredients" type="checkbox" name="ingredients[]" value="{{$ingredient->id}}" class="w-checkbox-input">
                        <label for="ingredients" class="w-form-label">{{$ingredient->name}}</label>
                    </div>
                @endforeach
            </div>
            <h4 class="form-mid-heading">Contents</h4>
            <div class="w-clearfix form-mid-div">
                @foreach($contents as $content)
                    <div class="w-checkbox checbox-field">
                        <input id="contents" type="checkbox" name="contents[]" value="{{$content->id}}" class="w-checkbox-input">
                        <label for="contents" class="w-form-label">{{$content->name}}</label>
                    </div>
                @endforeach
            </div>
            <a href="{{url('food')}}" class="w-button button-bad">CANCEL</a>
            <input type="submit" value="CREATE" data-wait="Please wait..." class="w-button button">
        </form>
    </div>
    </div>

@endsection

