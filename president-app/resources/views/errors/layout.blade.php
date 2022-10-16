<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="layout-navbar-fixed light-style layout-menu-fixed"
    dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('assets/') }}"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') | @lang('locale.app.title')</title>

    <link rel="icon" href="{{ asset('img/icons/logo-black.png') }}">

    {{-- <link rel="stylesheet" href="{{ asset('build/assets/app.f667c495.css') }}">
    <script src="{{ asset('build/assets/app.f6489cf9.js') }}" type="module"></script> --}}

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .misc-wrapper {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - (1.625rem * 2));
            text-align: center
        }
    </style>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.6.6/css/flag-icons.min.css" />
</head>

<body>
    @yield('content')
</body>

</html>
