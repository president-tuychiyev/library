@extends('layouts.root')

@section('modal')
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
@show
