@extends('layouts.root')

@section('title', 'Rollar')

@section('content')
    @php($name = 'name' . app()->getLocale())
    <div class="container-xxl flex-grow-1 container-p-y">


        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-sm-row mb-4">
                    <li class="nav-item">
                        <button class="nav-link active" type="button" onclick="addRole(this)" data-title="Rol qoʻshish"
                            data-bs-toggle="modal" data-bs-target="#roleModal">
                            <i class="bx bx bx-user-plus"></i>
                            Rol qoʻshish
                        </button>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row g-4 mb-4">
            @foreach ($roles as $r)
                @php($perForUpdate = '')
                @foreach ($r->permission as $p)
                    @foreach ($menus as $m)
                        @if ($p->menuId == $m->id)
                            @if ($p->create)
                                @php($perForUpdate = $perForUpdate . "menu[{$m->id}][create]@")
                            @endif
                            @if ($p->read)
                                @php($perForUpdate = $perForUpdate . "menu[{$m->id}][read]@")
                            @endif
                            @if ($p->update)
                                @php($perForUpdate = $perForUpdate . "menu[{$m->id}][update]@")
                            @endif
                            @if ($p->delete)
                                @php($perForUpdate = $perForUpdate . "menu[{$m->id}][delete]@")
                            @endif
                        @endif
                    @endforeach
                @endforeach
                <div class="col-md-6 col-lg-4 col-xl-6 order-0 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between">
                                <div class="content-left">
                                    <strong>{{ $r->$name }}</strong>
                                    <div class="d-flex align-items-end mt-2">
                                        <small>Foydalanuvchilar </small>
                                        <small class="text-success">({{ $users->where('roleId', $r->id)->count() }})</small>
                                    </div>
                                </div>
                                @if ($r->id != 1 && $r->id != 2 && $r->id != 3)
                                    <span class="rounded p-2">
                                        <button type="button" class="badge bg-label-primary" onclick="updateRole(this)"
                                            data-type="1" data-title="Fan yoʻnalishini yangilash"
                                            data-id="{{ $r->id }}" data-bs-toggle="modal" data-bs-target="#roleModal"
                                            data-langs="{{ $r->nameuz . '@' . $r->nameru . '@' . $r->nameen }}"
                                            data-permissions="{{ $perForUpdate }}"><i class="bx bx-edit"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-original-title="Yangilash"></i></button>
                                        <button type="button" class="badge bg-label-danger"
                                            data-href="{{ route('admin.roles.delete', $r->id) }}" data-bs-toggle="modal"
                                            data-bs-target="#confirmModal" onclick="deleteConfirmModal(this)"><i
                                                class="bx bx-trash" data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-original-title="Oʻchirish"></i></button>
                                    </span>
                                @endif
                            </div>
                            <hr class="mb-2 mt-2">
                            <div class="table-responsive text-nowrap">
                                <table class="table">
                                    <thead>
                                        <tr class="uppercase">
                                            <th>Menu nomi</th>
                                            <th class="text-center">Yaratish</th>
                                            <th class="text-center">O'qish</th>
                                            <th class="text-center">Yangilash</th>
                                            <th class="text-center">O'chirish</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @foreach ($r->permission as $p)
                                            @foreach ($menus as $m)
                                                @if ($p->menuId == $m->id)
                                                    <tr>
                                                        <td>{{ $m->$name }}</td>
                                                        <td class="text-center">
                                                            @if ($p->create)
                                                                <i class="bx bx-check-shield text-success"></i>
                                                            @else
                                                                <i class="bx bx-shield text-danger"></i>
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if ($p->read)
                                                                <i class="bx bx-check-shield text-success"></i>
                                                            @else
                                                                <i class="bx bx-shield text-danger"></i>
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if ($p->update)
                                                                <i class="bx bx-check-shield text-success"></i>
                                                            @else
                                                                <i class="bx bx-shield text-danger"></i>
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if ($p->delete)
                                                                <i class="bx bx-check-shield text-success"></i>
                                                            @else
                                                                <i class="bx bx-shield text-danger"></i>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>



        <!-- Modal -->
        <div class="modal fade" id="roleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="roleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ route('admin.roles.add') }}" method="post" id="modalForm"
                        data-add="{{ route('admin.roles.add') }}" data-update="{{ route('admin.roles.update') }}">
                        @csrf
                        <input type="number" name="id" hidden>
                        <div class="modal-header">
                            <label class="modal-title form-label" id="titleRole"></label>
                        </div>
                        <div class="modal-body">
                            <div class="col-12 fv-plugins-icon-container">
                                <div class="input-group input-group-merge mb-2">
                                    <input type="text" class="form-control" name="nameuz" placeholder="name uz" required
                                        data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip"
                                        data-bs-placement="top" title="majburiy bo'lim">
                                </div>
                                <div class="input-group input-group-merge mb-2">
                                    <input type="text" class="form-control" name="nameru" placeholder="name ru"
                                        required data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip"
                                        data-bs-placement="top" title="majburiy bo'lim">
                                </div>
                                <div class="input-group input-group-merge mb-2">
                                    <input type="text" class="form-control" name="nameen" placeholder="name en"
                                        required data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip"
                                        data-bs-placement="top" title="majburiy bo'lim">
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-flush-spacing">
                                        <thead>
                                            <tr>
                                                <td>Menu nomi</th>
                                                <td>Yaratish</th>
                                                <td>O'qish</td>
                                                <td>Yangilash</td>
                                                <td>O'chirish</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($menus as $m)
                                                <tr>
                                                    <td class="w-3">{{ $m->$name }}</td>
                                                    <td>
                                                        <label class="switch">
                                                            <input type="checkbox" class="switch-input"
                                                                name="menu[{{ $m->id }}][create]">
                                                            <span class="switch-toggle-slider">
                                                                <span class="switch-on">
                                                                    <i class="bx bx-check"></i>
                                                                </span>
                                                                <span class="switch-off">
                                                                    <i class="bx bx-x"></i>
                                                                </span>
                                                            </span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label class="switch">
                                                            <input type="checkbox" class="switch-input"
                                                                name="menu[{{ $m->id }}][read]">
                                                            <span class="switch-toggle-slider">
                                                                <span class="switch-on">
                                                                    <i class="bx bx-check"></i>
                                                                </span>
                                                                <span class="switch-off">
                                                                    <i class="bx bx-x"></i>
                                                                </span>
                                                            </span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label class="switch">
                                                            <input type="checkbox" class="switch-input"
                                                                name="menu[{{ $m->id }}][update]">
                                                            <span class="switch-toggle-slider">
                                                                <span class="switch-on">
                                                                    <i class="bx bx-check"></i>
                                                                </span>
                                                                <span class="switch-off">
                                                                    <i class="bx bx-x"></i>
                                                                </span>
                                                            </span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label class="switch">
                                                            <input type="checkbox" class="switch-input"
                                                                name="menu[{{ $m->id }}][delete]">
                                                            <span class="switch-toggle-slider">
                                                                <span class="switch-on">
                                                                    <i class="bx bx-check"></i>
                                                                </span>
                                                                <span class="switch-off">
                                                                    <i class="bx bx-x"></i>
                                                                </span>
                                                            </span>
                                                        </label>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
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
