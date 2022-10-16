@extends('layouts.root')

@section('title', 'Elektron kutbhona tizimida hisob yaratish')

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
                        <h2 class="text-center font-bold mb-5">Elektron manzilingizga kod yuborildi, quyida ushbu kodni
                            kiritish talab etiladi 🚀</h2>
                        <form id="registration-form" action="{{ route('auth.create.profile') }}" class="mb-3"
                            method="POST">
                            @csrf
                            <input type="text" value="{{ $userId }}" name="verifyId" id="verify-id" hidden
                                required>
                            <input type="number" value="3" name="position" id="position-id" hidden required>
                            <div class="mb-3">
                                <label for="verify-code" class="form-label">Tasdiqlash kodi</label>
                                <input type="text" class="form-control" id="verify-code" name="verifyCode"
                                    placeholder="Elektron pochtani tasdiqlash kodi kiriting" required
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-original-title="majburiy boʻlim" />
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">To'liq familiya, ismingiz</label>
                                <input type="text" id="name" class="form-control" name="name"
                                    placeholder="Familiya Ismingiz" required data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-original-title="majburiy boʻlim" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="phone">Telefon</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">+998</span>
                                    <input type="tel" id="phone" maxlength="9" minlength="9" pattern="[0-9]{2}[0-9]{3}[0-9]{2}[0-9]{2}"
                                        name="phone" class="form-control phone-mask" placeholder="901234567"
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-original-title="majburiy boʻlim" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="switches-stacked">
                                    <label class="switch switch-square">
                                        <input type="radio" class="switch-input" onchange="selectPosition(this)"
                                            data-position="student" checked name="switches-square-stacked-radio">
                                        <span class="switch-toggle-slider">
                                            <span class="switch-on"></span>
                                            <span class="switch-off"></span>
                                        </span>
                                        <span class="switch-label">Talaba</span>
                                    </label>

                                    <label class="switch switch-square">
                                        <input type="radio" class="switch-input" onchange="selectPosition(this)"
                                            data-position="teacher" name="switches-square-stacked-radio">
                                        <span class="switch-toggle-slider">
                                            <span class="switch-on"></span>
                                            <span class="switch-off"></span>
                                        </span>
                                        <span class="switch-label">O'qituvchi</span>
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3" id="systems">
                                <label class="form-label" for="select-group">Guruh</label>
                                <select class="form-select" name="systemId" id="select-group" required>
                                    @foreach ($groups as $group)
                                        <option value="{{ $group->id }}">{{ $group->group }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Parol</label>
                                </div>
                                <div class="input-group input-group-merge mb-3">
                                    <input type="password" minlength="8" id="password" class="form-control"
                                        name="pass"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" required data-bs-toggle="tooltip"
                                        data-bs-placement="top" data-bs-original-title="majburiy boʻlim" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100 bg-blue-500" type="submit">Hisob
                                    yaratish</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
