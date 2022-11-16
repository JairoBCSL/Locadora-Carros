@extends('layouts.app')

@section('content')
    <Clientes csrf_token="{{@csrf_token()}}"></Clientes>
@endsection
