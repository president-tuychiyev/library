@extends('errors.layout')

@section('title', 'Server xatoligi')

@section('content')
    <div class="container-xxl container-p-y">
        <div class="misc-wrapper">
            <h2 class="mb-2 mx-2 font-bold text-lg">Server xatoligi :(</h2>
            <p class="mb-4 mx-2">Sorov yuborishda xatolik sodir bo'ldi! 😖 Server xatoligi 500</p>
            <a href="/" class="btn btn-primary">Bosh sahifa</a>
            <div class="mt-3">
                <img src="{{ asset('img/page-misc-error-light.png') }}" alt="page-misc-error-light" width="500"
                    class="img-fluid">
            </div>
        </div>
    </div>
@stop
