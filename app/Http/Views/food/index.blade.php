@extends('layouts.app')
@section('head')
    <link type="text/css" rel="stylesheet" href="{{url('/').'/admin/css/jquery.dataTables.min.css'}}">
    <link type="text/css" rel="stylesheet" href="{{url('/').'/admin/css/dataTables.css'}}">

@endsection
@section('content')
    <div class="w-clearfix head-div">
        <a href="{{url('/food/create')}}" class="w-button button">NEW</a>
        <h2 class="heading2">Foods</h2>
    </div>
    <table id="myTable">
        <thead>
        <tr>
            <th>id</th>
            <th>category</th>
            <th>name</th>
            <th>description</th>
            <th>image</th>
            <th>action</th>
        </tr>
        </thead>
    </table>
@endsection
@section('foot')
    <script type="text/javascript" src="{{url('/').'/admin/js/jquery.dataTables.min.js'}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            oTable = $('#myTable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "/food/get",
                "columns": [
                    {data: 'id', name: 'id'},
                    {data: 'category.name', name: 'category.name'},
                    {data: 'name', name: 'name'},
                    {data: 'description', name: 'description'},
                    {data: 'image', name: 'image'},
                    {data: 'actions', name: 'actions'}
                ]
            });
        });
    </script>

@endsection