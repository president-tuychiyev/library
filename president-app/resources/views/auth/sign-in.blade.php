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
                        <h2 class="text-center font-bold mb-3">Elektron kutbhonaga hush kelibsiz! 👋</h2>
                        <form id="formAuthentication" action="{{ route('auth.check') }}" class="mb-3" action="#"
                            method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Email kiriting" required data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-original-title="majburiy boʻlim" />
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Parol</label>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" required data-bs-toggle="tooltip"
                                        data-bs-placement="top" data-bs-original-title="majburiy boʻlim" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember-me" />
                                    <label class="form-check-label" for="remember-me"> Eslab qolish </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100 bg-blue-500" type="submit">Kirish</button>
                            </div>
                        </form>
                        <p class="text-center">
                            <span>Hisobingiz yo'qmi?</span>
                            <a href="{{ route('auth.signUp') }}" class="text-violet-500">
                                <span>Hisob yaratish</span>
                            </a>
                        </p>
                        <div class="divider my-4">
                            <div class="divider-text">yoki</div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('auth.google.redirect') }}" class="btn btn-icon btn-label-google-plus me-3">
                                <i class="tf-icons bx bxl-google"></i>
                            </a>
                            <a href="{{ route('auth.google.redirect') }}" class="btn btn-icon btn-label-twitter me-3">
                                <i class="tf-icons bx bxl-twitter"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
