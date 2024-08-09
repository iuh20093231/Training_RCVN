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
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}"> --}}
    <script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
</head>

<body>
    <div id=app>
        <div class="container">
            <div class="p-5 form-login mt-5">
                <h1 class="text-center"><b>ĐĂNG NHẬP</b></h1>
                <task-login></task-login>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
</body>

</html>
