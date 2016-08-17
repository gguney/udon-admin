@section('head')
    <link type="text/css" rel="stylesheet" href="{{url('/').'/admin/css/jquery.dataTables.min.css'}}">
    <link type="text/css" rel="stylesheet" href="{{url('/').'/admin/css/dataTables.css'}}">
@endsection

    <table id="myTable">
        <thead>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>code</th>
            <th>description</th>
            <th>time zone</th>
            <th>actions</th>
        </tr>
        </thead>
    </table>

@section('foot')
    <script type="text/javascript" src="{{url('/').'/admin/js/jquery.dataTables.min.js'}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            oTable = $('#myTable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "/file/get",
                "columns": [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'code', name: 'code'},
                    {data: 'description', name: 'description'},
                    {data: 'time_zone', name: 'time_zone'},
                    {data: 'actions', name: 'actions'}
                ]
            });
        });
    </script>
@endsection