@extends('layouts.app')

@section('content')
    <Locacoes csrf_token="{{@csrf_token()}}"></Locacoes>
@endsection
