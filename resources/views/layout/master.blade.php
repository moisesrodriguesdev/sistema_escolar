<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('titulo', 'Home')</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <!-- Font Awesome JS -->
    <script src="https://kit.fontawesome.com/e5b2bd6d10.js" crossorigin="anonymous"></script>
<!-- <script src="{{ asset('js/loader.js') }}"></script> -->
</head>
<body onload="init()">
<div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <img src="{{ asset('img/logo.png') }}" style="fill: white">
        </div>
        <ul class="list-unstyled components">
            <li>
                <a href="{{ route('students.index') }}">
                    <i class="fas fa-user-graduate"></i>
                    <span class="title">Alunos</span>
                </a>
            </li>
            <li>
                <a href="{{ route('teams.index') }}">
                    <i class="fas fa-users"></i>
                    <span class="title">Turmas</span>
                </a>
            </li>
            <li>
                <a href="{{ route('schools.index') }}">
                    <i class="fas fa-school"></i>
                    <span class="title">Escolas</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Page Content  -->
    <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="btn btn-info">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </nav>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
                integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
                crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
                integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
                crossorigin="anonymous"></script>
        <script src="{{ asset('js/script-admin.js') }}"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>
</div>
@stack('scripts')
</body>
</html>
