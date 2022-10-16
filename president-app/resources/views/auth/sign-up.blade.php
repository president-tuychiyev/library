@extends('layouts.root')

@section('title', 'Elektron kutbhonaga kirish')

@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <div class="card">
                    <div class="card-body">
                        <div class="app-brand justify-content-center">
                            <a href="/" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <img class="w-16" src="{{ asset('img/icons/logo-black.png') }}"
                                        alt="kokand university">
                                </span>
                            </a>
                        </div>
                        <h2 class="text-center font-bold mb-2">Elektron kutbhonaga hush kelibsiz! 👋</h2>
                        <div class="mb-3 text-center">
                            Hisob yaratish uchun, elektron manzilingizni kiriting
                            <span class="bg-label-danger">Diqqat! Kiritilgan elektron manziliga tasdiqlash kodi yuboradi,
                                hisob ochish uchun ushbu kodni kiritishingiz zarur</span>
                        </div>
                        <form id="formAuthentication" action="{{ route('auth.send.code.email') }}" class="mb-3"
                            method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Email kiriting" required data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-original-title="majburiy boʻlim" required />
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100 bg-blue-500" type="submit">Ro'yhatdan
                                    o'tish</button>
                            </div>
                        </form>
                        <p class="text-center">
                            <span>Hisobingiz bormi?</span>
                            <a href="{{ route('auth.signIn') }}" class="text-violet-500">
                                <span>Hisobga kirish</span>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
