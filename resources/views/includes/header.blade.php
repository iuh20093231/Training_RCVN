<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $tittle }}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link rel="stylesheet" type="text/css" href="{{ asset('Font_awesome/css/fontawesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Font_awesome/css/brands.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Font_awesome/css/regular.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Font_awesome/css/solid.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Font_awesome/css/svg-with-js.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Font_awesome/css/v4-shims.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Font_awesome/css/all.min.css') }}" />
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.7/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
</head>