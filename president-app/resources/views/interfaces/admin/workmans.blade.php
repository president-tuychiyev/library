@extends('layouts.root')

@section('title', 'Xodimlar')

@section('search')
    <form action="{{ route('admin.workmans.search') }}" method="get">
        <input type="text" class="form-control border-0 shadow-none" name="q" placeholder="Xodimni qidirish..."
            aria-label="Xodimni qidirish...">
    </form>
@stop

@section('content')
    @php($name = 'name' . app()->getLocale())
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-sm-row mb-4">
                    <li class="nav-item">
                        <button class="nav-link active" type="button" onclick="addWorkman(this)"
                            data-title="Foydalanuvchi qoʻshish" data-bs-toggle="modal" data-bs-target="#workmanModal">
                            <i class="bx bx bx-user-plus"></i>
                            Foydalanuvchi qoʻshish
                        </button>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row g-4">
            @foreach ($workmans as $w)
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="dropdown btn-pinned">
                                <button type="button" class="px-2" onclick="updateWorkman(this)" data-title="Yangilash"
                                    data-id="{{ $w->id }}" data-bs-toggle="modal" data-bs-target="#workmanModal"
                                    data-name="{{ $w->name }}" data-phone="{{ $w->phone }}"
                                    data-email="{{ $w->email }}" data-active="{{ $w->isActive }}"
                                    data-role="{{ $w->roleId }}"><i class="bx bx-edit" data-bs-toggle="tooltip"
                                        data-bs-placement="top" data-bs-original-title="Yangilash"></i></button>
                                <button type="button" data-href="{{ route('admin.workmans.delete', $w->id) }}"
                                    data-bs-toggle="modal" data-bs-target="#confirmModal"
                                    onclick="deleteConfirmModal(this)"><i class="bx bx-trash" data-bs-toggle="tooltip"
                                        data-bs-placement="top" data-bs-original-title="Oʻchirish"></i></button>
                            </div>
                            <div class="mx-auto mb-3">
                                <img src="{{ asset($w->media->fullPath) }}" alt="Avatar Image"
                                    class="rounded-circle w-px-100 h-px-100 mx-auto d-block">
                            </div>
                            <h5 class="mb-1 card-title">{{ $w->name }}</h5>
                            <strong class="">{{ $w->role->nameuz }}</strong>
                            <div class="d-flex align-items-center justify-content-center my-3 gap-2">
                                <span class="badge bg-label-secondary me-1">Holati</span>
                                @if ($w->isActive)
                                    <small class="badge bg-label-primary me-1" data-bs-toggle="tooltip"
                                        data-bs-placement="top" data-bs-original-title="Aktiv"> <i
                                            class="bx bx-check-shield"></i></small>
                                @else
                                    <small class="badge bg-label-danger me-1" data-bs-toggle="tooltip"
                                        data-bs-placement="top" data-bs-original-title="Aktiv emas"><i
                                            class="bx bx-shield-alt-2"></i></small>
                                @endif
                            </div>

                            <div class="align-items-center justify-content-around my-4 py-2">
                                <div>
                                    <h4 class="mb-1">{{ $w->user->name }}</h4>
                                    <span>Tomonidan, {{ $w->created_at->format('d.m.Y') }}da qo'shilgan</span>
                                </div>
                                <hr class="mb-2 mt-2">
                            </div>
                            <div class="d-flex align-items-center justify-content-center">
                                <a href="tel:+998{{ $w->phone }}" target="_blank"
                                    class="btn btn-primary d-flex align-items-center me-3" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-original-title="+(998) {{ $w->phone }}"><i
                                        class="bx bx-phone me-1"></i>Bog'lanish</a>
                                <a href="mailto:{{ $w->email }}" target="_blank"
                                    class="btn btn-label-secondary btn-icon" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-original-title="{{ $w->email }}"><i
                                        class="bx bx-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="card-footer">
                {{ $workmans->links('pagination::bootstrap-5') }}
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="workmanModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="workmanModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="#" method="post" id="modalForm" data-add="{{ route('admin.workmans.add') }}"
                        data-update="{{ route('admin.workmans.update') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="number" name="id" hidden>
                        <div class="modal-header">
                            <label class="modal-title form-label" id="titleWorkman"></label>
                        </div>
                        <div class="modal-body">
                            <div class="col-12 fv-plugins-icon-container">
                                <div class="input-group input-group-merge mb-2">
                                    <input type="text" class="form-control" name="name" placeholder="F.I.O"
                                        required data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip"
                                        data-bs-placement="top" title="majburiy bo'lim">
                                </div>
                                <div class="input-group input-group-merge mb-2">
                                    <span class="input-group-text select-none">+998</span>
                                    <input type="number" maxlength="9" class="form-control" name="phone"
                                        placeholder="9* *** ** **" required data-bs-toggle="tooltip"
                                        data-bs-custom-class="custom-tooltip" data-bs-placement="top"
                                        title="majburiy bo'lim">
                                </div>
                                <div class="input-group input-group-merge mb-2">
                                    <input type="email" maxlength="30" class="form-control" name="email"
                                        placeholder="Pochta manzili" required data-bs-toggle="tooltip"
                                        data-bs-custom-class="custom-tooltip" data-bs-placement="top"
                                        title="majburiy bo'lim">
                                </div>
                                <div class="mb-2 form-password-toggle fv-plugins-icon-container">
                                    <div class="input-group input-group-merge">
                                        <input class="form-control" type="password" name="pass"
                                            placeholder="············" required data-bs-toggle="tooltip"
                                            data-bs-custom-class="custom-tooltip" data-bs-placement="top"
                                            title="majburiy bo'lim">
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div>
                                </div>
                                <div class="input-group input-group-merge mb-2">
                                    <select class="form-select" name="roleId" id="select-document-type" required
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-original-title="majburiy boʻlim">
                                        @foreach ($roles as $r)
                                            <option value="{{ $r->id }}">{{ $r->$name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-group input-group-merge mb-3">
                                    <input class="form-control" name="avatar" type="file" id="cover-media-book"
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Foydalanuvchi rasmini tanlang | *majburiy emas" accept=".jpg,.jpeg,.png">
                                    <span class="input-group-text text-red-300 select-none">*jpg,
                                        *png</span>
                                </div>
                                <label class="switch">
                                    <input type="checkbox" name="isActiveCheck" id="isActive" class="switch-input">
                                    <span class="switch-toggle-slider">
                                        <span class="switch-on">
                                            <i class="bx bx-check"></i>
                                        </span>
                                        <span class="switch-off">
                                            <i class="bx bx-x"></i>
                                        </span>
                                    </span>
                                    <span class="switch-label">Aktivmi ?</span>
                                </label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-danger bg-red-600" data-bs-dismiss="modal">Bekor
                                qilish</button>
                            <button type="submit" class="btn btn-primary bg-blue-800">Saqlash</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--/ Modal for add data -->
    </div>
@stop
