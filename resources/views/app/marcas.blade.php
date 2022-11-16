@extends('layouts.app')

@section('content')
    <Marcas csrf_token="{{@csrf_token()}}"></Marcas>
@endsection
