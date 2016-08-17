@extends('layouts.app')
@section('content')
    <div class="w-form form-wrapper">
        <div class="w-form">
            {{ Form::model($menu, array('route' => array('menu.update', $menu->id), 'method' => 'PUT')) }}
            <h3 class="heading">Edit a Menu</h3>
            {!! csrf_field() !!}
            <label for="management" class="form-label">Management</label>
            <select id="management" name="management" class="w-select select-field">
                @foreach($managements as $management)
                    @if($management->id == $menu->ref_management_id)
                        <option value="{{$management->id}}" selected>{{$management->company_name }}</option>
                    @else
                        <option value="{{$management->id}}">{{$management->company_name }}</option>
                    @endif
                @endforeach
            </select>
            @if ($errors->has('management'))
                <span class="help-block">
                    <strong>{{ $errors->first('management') }}</strong>
                </span>
            @endif
            <label for="name" class="form-label">Name</label>
            <input id="name" type="text" placeholder="Enter a name" name="name" data-name="name"
                   class="w-input text-field" value="{{ $menu->name }}">
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
            <label for="description" class="form-label">Description</label>
            <input id="description" type="text" placeholder="Enter a description" name="description" data-name="description"
                   class="w-input text-field" value="{{ $menu->description }}">
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

