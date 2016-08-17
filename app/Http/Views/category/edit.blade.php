@extends('layouts.app')
@section('content')
    <div class="w-form form-wrapper">
        <div class="w-form">
            {{ Form::model($category, array('route' => array('category.update', $category->id), 'method' => 'PUT')) }}
            <h3 class="heading">Edit a Category</h3>
            {!! csrf_field() !!}
            <label for="menu" class="form-label">Menu</label>
            <select id="menu" name="menu" class="w-select select-field">
                @foreach($menus as $menu)
                    @if($menu->id == $category->ref_menu_id)
                        <option value="{{$menu->id}}" selected>{{$menu->name }}</option>
                    @else
                        <option value="{{$menu->id}}">{{$menu->name }}</option>
                    @endif
                @endforeach
            </select>
            @if ($errors->has('menu'))
                <span class="help-block">
                    <strong>{{ $errors->first('menu') }}</strong>
                </span>
            @endif
            <label for="name" class="form-label">Name</label>
            <input id="name" type="text" placeholder="Enter a name" name="name" data-name="name"
                   class="w-input text-field" value="{{ $category->name }}">
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
            <label for="description" class="form-label">Description</label>
            <input id="description" type="text" placeholder="Enter a description" name="description" data-name="description"
                   class="w-input text-field" value="{{ $category->description }}">
            @if ($errors->has('description'))
                <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif

                <a href="{{url('menu')}}" class="w-button button-bad">CANCEL</a>
                <input type="submit" value="EDIT" data-wait="Please wait..." class="w-button button">
            </form>
        </div>
    </div>
@endsection

