@extends('layouts.app')
@section('head')
    <link type="text/css" rel="stylesheet" href="{{url('/').'/admin/css/jquery.dataTables.min.css'}}">
    <link type="text/css" rel="stylesheet" href="{{url('/').'/admin/css/dataTables.css'}}">
@endsection
@section('content')
    <div class="w-form form-wrapper">
        <div class="w-form">
            {{ Form::model($management, array('route' => array('management.update', $management->id), 'method' => 'PUT','enctype'=>'multipart/form-data' )) }}
                <h3 class="heading">Edit a Management</h3>
            {!! csrf_field() !!}
            <label for="owner" class="form-label">Owner</label>
            <select id="owner" name="owner" class="w-select select-field">
                @foreach($users as $user)
                    @if($management->ref_owner_id == $user->id)
                        <option value="{{$user->id}}" selected>{{$user->username }}</option>
                    @else
                        <option value="{{$user->id}}">{{$user->username }}</option>
                    @endif
                @endforeach
            </select>
            @if ($errors->has('owner'))
                <span class="help-block">
                    <strong>{{ $errors->first('owner') }}</strong>
                </span>
            @endif
            <label for="brand_name" class="form-label">Brand Name</label>
            <input id="brand_name" type="text" placeholder="Enter a brand name" name="brand_name" data-name="brand_name"
                   class="w-input text-field" value="{{ $management->brand_name}}">
            @if ($errors->has('brand_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('brand_name') }}</strong>
                </span>
            @endif
            <label for="company_name" class="form-label">Company Name</label>
            <input id="company_name" type="text" placeholder="Enter a company name" name="company_name" data-name="company_name"
                   class="w-input text-field" value="{{ $management->company_name  }}">
            @if ($errors->has('company_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('company_name') }}</strong>
                </span>
            @endif
            <label for="tax_number" class="form-label">Tax Number</label>
            <input id="tax_number" type="text" placeholder="Enter a tax number" name="tax_number" data-name="tax_number"
                   class="w-input text-field" value="{{ $management->tax_number }}">
            @if ($errors->has('tax_number'))
                <span class="help-block">
                    <strong>{{ $errors->first('tax_number') }}</strong>
                </span>
            @endif
                <a href="{{url('management')}}" class="w-button button-bad">CANCEL</a>
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
                "ajax": "/file/getManagement/"+{{$management->id}},
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