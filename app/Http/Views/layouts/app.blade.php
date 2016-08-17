<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="" name="description">
    <meta content="" name="author">
    <title>{{Config::get('app.name')}}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js"></script>
    <script src="{{url('/').'/admin/js/lightbox-gg.js'}}"></script>
    <link type="text/css" rel="stylesheet" href="{{url('/').'/admin/css/jquery.dataTables.min.css'}}">
    <link type="text/css" rel="stylesheet" href="{{url('/').'/admin/css/dataTables.css'}}">
    <script>
        WebFont.load({
            google: {
                families: ["Crimson Text:regular,italic,600,600italic,700,700italic"]
            }
        });
    </script>
    <link type="text/css" rel="stylesheet" href="{{url('/').'/admin/css/normalize.css'}}">
    <link type="text/css" rel="stylesheet" href="{{url('/').'/admin/css/webflow.css'}}">
    <link type="text/css" rel="stylesheet" href="{{url('/').'/admin/css/adminudonsy.webflow.css'}}">
    <link type="text/css" rel="stylesheet" href="{{url('/').'/admin/css/additional.css'}}">
    <link rel="stylesheet" href="{{url('/').'/admin/css/font-awesome.min.css'}}">

    @yield('head')
    <link rel="shortcut icon" type="image/x-icon" href="">
    <link rel="apple-touch-icon" href="">
</head>
<body>
@include('layouts.menu')
<div class="w-section main-section">
    <div class="main-container">
        @yield('content')
    </div>
</div>
@if(Session::get('message'))
<div data-ix="new-interaction" class="popup-div">
    <h4 class="popup-heading">MESSAGE</h4>
    <div style="margin-left:10px;margin-right:10px;">{{Session::get('message')}}</div>

</div>
@endif
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script type="text/javascript" src="{{  url('/').'/admin/js/webflow.js'}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script>
@yield('foot')
</body>





