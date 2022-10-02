<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="layout-navbar-fixed light-style layout-menu-fixed"
    dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('assets/') }}"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') | Elektron kutubxona tizimi</title>
{{-- 
    <link rel="stylesheet" href="{{ asset('build/assets/app.df12c049.css') }}">
    <script src="{{ asset('build/assets/app.8ba65905.js') }}" type="module"></script> --}}

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.6.6/css/flag-icons.min.css" />
</head>

<body>

    @empty(session()->has('user'))
        @yield('content')
    @else
        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
                <div class="layout-overlay layout-menu-toggle"></div>
                <x-sidebar />

                <div class="layout-page">
                    <x-navbar-admin />

                    <div class="content-wrapper">
                        @yield('content')
                    </div>
                </div>

            </div>
        </div>
    @endempty

    <!-- begin::confirm model -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content items-center justify-center">
                <div class="modal-body">
                    <strong>Rostdan ham o'chirishni hohlaysimi ?</strong>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger bg-red-600" data-bs-dismiss="modal">Orqaga</button>
                    <a id="deleteBookBtn" class="btn btn-primary bg-blue-500">O'chirish</a>
                </div>
            </div>
        </div>
    </div>
    <!-- end::confirm model -->



    @if (session()->has('msg') or $errors->any())
        <!-- begin::messages -->
        <audio id="error-audio" src="{{ asset('img/alert.mp3') }}" preload="auto"></audio>
        <script>
            Swal.fire({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                },
                @if ($errors->any())
                    title: "{!! implode('', $errors->all(':message')) !!}",
                    icon: "error",
                @else
                    title: "{{ session()->get('msg')['title'] }}",
                    icon: "{{ session()->get('msg')['icon'] }}"
                @endif
            })

            @if (session()->get('msg')['icon'] == 'error')
                document.getElementById('error-audio').play();
            @endif
        </script>
        <!-- end::messages -->
    @endif
</body>

</html>
