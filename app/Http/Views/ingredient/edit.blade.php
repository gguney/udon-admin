@extends('layouts.app')
@section('head')
    <link type="text/css" rel="stylesheet" href="{{url('/').'/admin/css/jquery.dataTables.min.css'}}">
    <link type="text/css" rel="stylesheet" href="{{url('/').'/admin/css/dataTables.css'}}">
@endsection
@section('content')
    <div class="w-form form-wrapper">
        <div class="w-form">
            {{ Form::model($ingredient, array('route' => array('ingredient.update', $ingredient->id), 'method' => 'PUT','enctype'=>'multipart/form-data' )) }}
                <h3 class="heading">Edit a Ingredient</h3>
                {!! csrf_field() !!}
                <label for="name" class="form-label">Name</label>
                <input id="name" type="text" placeholder="Enter a name" name="name" data-name="name"
                       class="w-input text-field" value="{{ $ingredient->name}}">
                @if ($errors->has('name'))
                    <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
                <label for="description" class="form-label">Description</label>
                <input id="description" type="text" placeholder="Enter a description" name="description" data-name="description"
                       class="w-input text-field" value="{{ $ingredient->description }}">
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
                <a href="{{url('ingredient')}}" class="w-button button-bad">CANCEL</a>
                <input type="submit" value="EDIT" data-wait="Please wait..." class="w-button button">
            </form>
            <h4 class="form-mid-heading">Images</h4>
            <div class="w-clearfix form-mid-div" style="min-height: 300px ">
                <table id="myTable">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>file_name</th>
                        <th>image</th>
                        <th>actions</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

@endsection
@section('foot')
    <script type="text/javascript" src="{{url('/').'/admin/js/jquery.dataTables.min.js'}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            oTable = $('#myTable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "/file/getIngredient/"+{{$ingredient->id}},
                "columns": [
                    {data: 'id', name: 'id'},
                    {data: 'file_name', name: 'file_name'},
                    {data: 'image', name: 'image'},
                    {data: 'actions', name: 'actions'}
                ]
            });
        });
    </script>
@endsection