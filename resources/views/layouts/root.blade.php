<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light-style layout-menu-fixed" dir="ltr"
    data-theme="theme-default" data-assets-path="{{ asset('assets/') }}" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

        <div class="modal-backdrop fade hidden"></div>
    @endempty


    @if (session()->has('msg'))
        <!-- begin::messages -->
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
                title: "{{ session()->get('msg')['title'] }}",
                icon: "{{ session()->get('msg')['icon'] }}"
            })
        </script>
        <!-- end::messages -->
    @endif
</body>

</html>
