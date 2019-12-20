<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '') }}</title>

    <!-- Scripts -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>
    <script src="{{ asset('js/navbar.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
{{--  <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
<!-- Styles -->
    <link href="{{ asset('css/SP/header.css') }}" rel="stylesheet">
    <link href="{{ asset('css/PC/header.css') }}" rel="stylesheet">

    <link href="{{ asset('css/SP/top.css') }}" rel="stylesheet">
</head>
@include('layouts.header')
@yield('content')
@include('layouts.footer')
</html>
