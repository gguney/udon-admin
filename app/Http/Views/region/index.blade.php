@extends('layouts.app')
@section('head')
    <link type="text/css" rel="stylesheet" href="{{url('/').'/admin/css/jquery.dataTables.min.css'}}">
    <link type="text/css" rel="stylesheet" href="{{url('/').'/admin/css/dataTables.css'}}">
@endsection
@section('content')
    <div class="w-clearfix head-div">
        <a href="{{url('/region/create')}}" class="w-button button">NEW</a>
        <h2 class="heading2">Regions</h2>
    </div>
    <table id="myTable">
        <thead>
        <tr>
            <th>id</th>
            <th>city</th>
            <th>name</th>
            <th>postal code</th>
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
                "ajax": "/region/get",
                "columns": [
                    {data: 'id', name: 'id'},
                    {data: 'city.name', name: 'city.name'},
                    {data: 'name', name: 'name'},
                    {data: 'postal_code', name: 'postal_code'},
                    {data: 'actions', name: 'actions'}
                ]
            });
        });
    </script>
@endsection