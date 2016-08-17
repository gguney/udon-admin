@extends('layouts.app')
@section('head')

@endsection
@section('content')
    <div class="w-clearfix head-div">
        <a href="{{url('/management/create')}}" class="w-button button">NEW</a>
        <h2 class="heading2">Managements</h2>
    </div>
    <table id="myTable">
        <thead>
        <tr>
            <th>id</th>
            <th>owner</th>
            <th>brand name</th>
            <th>company name</th>
            <th>tax number</th>
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
                "ajax": "/management/get",
                "columns": [
                    {data: 'id', name: 'id'},
                    {data: 'owner.username', name: 'owner.username'},
                    {data: 'brand_name', name: 'brand_name'},
                    {data: 'company_name', name: 'company_name'},
                    {data: 'tax_number', name: 'tax_number'},
                    {data: 'image', name: 'image'},
                    {data: 'actions', name: 'actions'}
                ]
            });
        });
    </script>
@endsection