@extends('layouts.app')
@section('content')

    You are logged in!
    {{Auth::User()
    }}

@endsection
