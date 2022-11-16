@extends('layouts.app')

@section('content')
    <Carros csrf_token="{{@csrf_token()}}"></Carros>
@endsection
