@extends('layouts.root')

@section('title', 'Foydalanuvchi')

@section('search')
    <form
        action="{{ route('admin.users.search', $role) }}"
        method="get">
        <input type="text" class="form-control border-0 shadow-none" name="q" placeholder="Foydalanuvchini qidirish..."
            aria-label="Foydalanuvchini qidirish...">
    </form>
@stop

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                <div class="card-title mb-0">
                    <strong class="m-0 me-2">
                        @if ($role == 2)
                            O'qituvchi
                        @else
                            Talaba
                        @endif
                    </strong>
                </div>
                <button class="btn p-0 text-violet-800" type="button" onclick="addUser(this)"
                    data-title="@if ($role == 2) O'qituvchi @else Talaba @endif qoʻshish"
                    data-bs-toggle="modal" data-bs-target="#userModal">
                    <i class="bx bx-message-square-add text-xl" data-bs-toggle="tooltip" data-bs-placement="top"
                        data-bs-original-title="@if ($role == 2) O'qituvchi @else Talaba @endif qoʻshish"></i>
                </button>
            </div>
            <hr class="mt-3">
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr class="text-center">
                                <th>№</th>
                                <th>F.I.O</th>
                                <th>avatar</th>
                                <th>qr</th>
                                <th>holati</th>
                                <th>yaratuvchi</th>
                                <th>yaratilgan sana</th>
                                <th>harakatlar</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($users as $i => $u)
                                <tr class="text-center">
                                    <td><strong>{{ $i + 1 }}</strong></td>
                                    <td>{{ $u->name }}</td>
                                    <td><img class="rounded-circle" style="width: 8ex"
                                            src="{{ asset($u->media->fullPath) }}" alt="{{ $u->name }}">
                                    </td>
                                    <td>
                                        <div id="user-qrcode">
                                            {!! DNS2D::getBarcodeSVG((string) $u->id, 'QRCODE') !!}
                                        </div>
                                    </td>
                                    <td>
                                        @if ($u->isActive)
                                            <small class="badge bg-label-primary me-1"> <i class="bx bx-check-shield"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-original-title="Aktiv"></i></small>
                                        @else
                                            <small class="badge bg-label-danger me-1"><i class="bx bx-shield-alt-2"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-original-title="Aktiv emas"></i></small>
                                        @endif
                                    </td>
                                    <td>{{ $u->user->name }}</td>
                                    <td>{{ $u->created_at->format('d.m.Y') }}</td>
                                    <td>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#infoModal"
                                            onclick="infoUser({{ $u->id }})"><i class='bx bx-show'
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-original-title="Ko'rish"></i></button>
                                        <button type="button" class="px-2" onclick="updateUser(this)"
                                            data-title="Yangilash" data-id="{{ $u->id }}" data-bs-toggle="modal"
                                            data-bs-target="#userModal" data-name="{{ $u->name }}"
                                            data-phone="{{ $u->phone }}" data-email="{{ $u->email }}"
                                            data-active="{{ $u->isActive }}" data-system="{{ $u->systemId }}">
                                            <i class="bx bx-edit" data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-original-title="Yangilash"></i></button>
                                        <button type="button" data-href="{{ route('admin.users.delete', $u->id) }}"
                                            data-bs-toggle="modal" data-bs-target="#confirmModal"
                                            onclick="deleteConfirmModal(this)"><i class="bx bx-trash"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-original-title="Foydalanuvchini oʻchirish"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                {{ $users->links('pagination::bootstrap-5') }}
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="userModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="userModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="#" method="post" id="modalForm" data-add="{{ route('admin.users.add') }}"
                        data-update="{{ route('admin.users.update') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="number" name="id" hidden>
                        <input type="number" name="roleId" value="{{ $role }}" hidden required>
                        <div class="modal-header">
                            <label class="modal-title form-label" id="titleUsers"></label>
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
                                @if (isset($groups))
                                    <div class="input-group input-group-merge mb-2">
                                        <select class="form-select" name="systemId" id="select-document-type" required
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-original-title="majburiy boʻlim">
                                            @foreach ($groups as $g)
                                                <option value="{{ $g->id }}">{{ $g->group }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
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

        <!-- Info Modal -->
        <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="infoModalLabel">Umumiy ma'lumot</h5>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex align-items-center row">
                            <div class="col-sm-5">
                                <div class="card-body">
                                    <img class="rounded" src="/" id="avatar-info-modal" height="140">
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="card-body">
                                    <h2 class="card-title font-bold mb-1" id="user-name-info-modal"></h2>
                                    <p class="mb-1"><span class="font-bold">Guruhi:</span> <span
                                            id="group-info-modal"></span></p>
                                    <p class="mb-1"><span class="font-bold">Email:</span> <span
                                            id="email-info-modal"></span></p>
                                    <p class="mb-1"><span class="font-bold">Telefon:</span> <span
                                            id="phone-info-modal"></span></p>
                                    <span class="badge bg-label-primary">Jami o'qilgan kitoblar soni: <span
                                            id="books-info-modal"></span> dona</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger bg-red-600" data-bs-dismiss="modal">Orqaga</button>
                        <button type="button" class="btn btn-primary bg-blue-700"
                            onclick="printDocument()">Guvohnoma</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4 mb-4 order-lg-1 order-2 max-w-xs3" id="printDiv" hidden>
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-8">
                    <div class="card-body">
                        <h6 class="card-title mb-1 text-nowrap font-bold" id="user-name-doc"></h6>
                        <h5 class="card-title text-primary mb-1" id="email-doc"></h5>
                        <h5 class="card-title text-primary mb-1" id="phone-doc"></h5>
                    </div>
                </div>
                <div class="col-4">
                    <div id="qr-code" class="inline-block relative bottom-5"></div>
                </div>
            </div>
        </div>
    </div>
@stop
