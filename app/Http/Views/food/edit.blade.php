@extends('layouts.app')
@section('content')
    <div class="w-form form-wrapper">
        <div class="w-form">
            {{ Form::model($food, array('route' => array('food.update', $food->id), 'method' => 'PUT')) }}
            <h3 class="heading">Edit a Food</h3>
            {!! csrf_field() !!}
            <label for="category" class="form-label">Category</label>
            <select id="category" name="category" class="w-select select-field">
                @foreach($categories as $category)
                    @if($category->id == $food->ref_category_id)
                        <option value="{{$category->id}}" selected>{{$category->name }}</option>
                    @else
                        <option value="{{$category->id}}">{{$category->name }}</option>
                    @endif
                @endforeach
            </select>
            @if ($errors->has('category'))
                <span class="help-block">
                    <strong>{{ $errors->first('category') }}</strong>
                </span>
            @endif
            <label for="name" class="form-label">Name</label>
            <input id="name" type="text" placeholder="Enter a name" name="name" data-name="name"
                   class="w-input text-field" value="{{ $food->name }}">
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
            <label for="description" class="form-label">Description</label>
            <input id="description" type="text" placeholder="Enter a description" name="description" data-name="description"
                   class="w-input text-field" value="{{ $food->description }}">
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
                        @if(in_array($ingredient->id,$foodsIngredients))
                        <input id="ingredients" type="checkbox" name="ingredients[]" value="{{$ingredient->id}}" class="w-checkbox-input"  checked="checked">
                        @else
                            <input id="ingredients" type="checkbox" name="ingredients[]" value="{{$ingredient->id}}" class="w-checkbox-input">
                        @endif
                        <label for="ingredients" class="w-form-label">{{$ingredient->name}}</label>
                    </div>
                @endforeach
            </div>
            <h4 class="form-mid-heading">Contents</h4>
            <div class="w-clearfix form-mid-div">
                @foreach($contents as $content)
                    <div class="w-checkbox checbox-field">
                        @if(in_array($content->id,$foodsContents))
                             <input id="contents" type="checkbox" name="contents[]" value="{{$content->id}}" class="w-checkbox-input"  checked="checked">
                        @else
                            <input id="contents" type="checkbox" name="contents[]" value="{{$content->id}}" class="w-checkbox-input">
                        @endif
                        <label for="contents" class="w-form-label">{{$content->name}}</label>
                    </div>
                @endforeach
            </div>
                <a href="{{url('food')}}" class="w-button button-bad">CANCEL</a>
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
                "ajax": "/file/getFood/"+{{$food->id}},
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