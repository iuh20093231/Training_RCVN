<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Task Manager</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Font_awesome/css/fontawesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Font_awesome/css/brands.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Font_awesome/css/regular.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Font_awesome/css/solid.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Font_awesome/css/svg-with-js.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Font_awesome/css/v4-shims.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Font_awesome/css/all.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
    <div id="app" class="mt-1">
        <div class="container">
            @include('task.navbar')
            <header class="row mt-3">
                <nav>
                    <h1> TO DO LIST </h1>
                </nav>
            </header>
            <task-manager></task-manager>
            <add-user></add-user>
            <footer class="row mt-2">
                <p>&copy; 2024 To Do List</p>
            </footer>
        </div>
    </div>
</body>
</html>