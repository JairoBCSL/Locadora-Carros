@extends('layouts.app')

@section('content')
    <Home csrf_token="{{@csrf_token()}}"></Home>
@endsection
