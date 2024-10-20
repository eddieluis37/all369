@extends('layouts.bt4.app')

@section('title', '- Formulario de Requerimientos')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<link href="{{ asset('css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css"/>



@include('request_form.partials.nav')

@endsection

