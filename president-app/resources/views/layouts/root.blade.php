<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="layout-navbar-fixed light-style layout-menu-fixed"
    dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('assets/') }}"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') | @lang('locale.app.title')</title>

    <link rel="icon" href="{{ asset('img/icons/logo-black.png') }}">

    {{-- <link rel="stylesheet" href="{{ asset('build/assets/app.e9ff78f0.css') }}">
    <script src="{{ asset('build/assets/app.c20ff6ef.js') }}" type="module"></script> --}}

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.6.6/css/flag-icons.min.css" />
</head>

<body>

    @if (!session()->has('admin') && !session()->has('client'))
        @yield('content')
    @else
        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
                <div class="layout-overlay layout-menu-toggle"></div>
                @if (session()->has('admin'))
                    <x-admin.sidebar />
                    <div class="layout-page">
                        <x-admin.navbar />
                        <div class="content-wrapper">
                            @yield('content')
                        </div>
                    </div>
                @elseif (session()->has('client'))
                    <x-client.sidebar />
                    <div class="layout-page">
                        <x-client.navbar />
                        <div class="content-wrapper">
                            @yield('content')
                        </div>
                    </div>
                @endif

            </div>
        </div>
    @endempty

    @include('components.modal')

</body>

</html>
