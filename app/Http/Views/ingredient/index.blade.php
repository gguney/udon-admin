@extends('layouts.app')
@section('head')
    <link type="text/css" rel="stylesheet" href="{{url('/').'/admin/css/jquery.dataTables.min.css'}}">
    <link type="text/css" rel="stylesheet" href="{{url('/').'/admin/css/dataTables.css'}}">
@endsection
@section('content')
    <div class="w-clearfix head-div">
        <a href="{{url('/ingredient/create')}}" class="w-button button">NEW</a>
        <h2 class="heading2">Ingredients</h2>
    </div>
    <table id="myTable">
        <thead>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>description</th>
            <th>image</th>
            <th>actions</th>
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
                "ajax": "/ingredient/get",
                "columns": [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'description', name: 'description'},
                    {data: 'image', name: 'image'},
                    {data: 'actions', name: 'actions'}
                ]
            });
        });
    </script>
@endsection