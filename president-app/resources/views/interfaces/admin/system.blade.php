@extends('layouts.root')

@section('title', 'Tuzilma')

@section('content')

    @php($name = 'name' . app()->getLocale())

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Facultys -->
            <div class="col-md-6 col-lg-4 col-xl-6 order-0 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                        <div class="card-title mb-0">
                            <strong class="m-0 me-2">Fakultetlar</strong>
                        </div>
                        <button class="btn p-0 text-violet-800" type="button" onclick="addDetail(this)"
                            data-title="Fakultet qoʻshish" data-type="9" data-bs-toggle="modal"
                            data-bs-target="#detailModal">
                            <i class="bx bx-message-square-add text-xl" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-original-title="Fakultet qoʻshish"></i>
                        </button>
                    </div>
                    <hr class="mt-3">
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr class="uppercase">
                                        <th>№</th>
                                        <th>nomi</th>
                                        <th class="text-center">holati</th>
                                        <th>yaratuvchi</th>
                                        <th class="text-center">harakatlar</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($facultys as $i => $f)
                                        <tr>
                                            <td class="font-medium">{{ $i+1 }}</td>
                                            <td>{{ $f->$name }}</td>
                                            <td class="text-center">
                                                @if ($f->isActive)
                                                    <small class="badge bg-label-primary me-1" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" data-bs-original-title="Aktiv"> <i
                                                            class="bx bx-check-shield"></i></small>
                                                @else
                                                    <small class="badge bg-label-danger me-1" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" data-bs-original-title="Aktiv emas"><i
                                                            class="bx bx-shield-alt-2"></i></small>
                                                @endif
                                            </td>
                                            <td>{{ $f->user->name }}</td>
                                            <td class="text-center">
                                                <button type="button" class="px-2" onclick="updateDetail(this)"
                                                    data-type="1" data-title="Kitob turini yangilash"
                                                    data-id="{{ $f->id }}" data-bs-toggle="modal"
                                                    data-bs-target="#detailModal"
                                                    data-langs="{{ $f->nameuz . '@' . $f->nameru . '@' . $f->nameen }}"><i
                                                        class="bx bx-edit" data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-original-title="Kitob turini yangilash"></i></button>
                                                <button type="button"
                                                    data-href="{{ route('admin.datail.book.delete', $f->id) }}"
                                                    data-bs-toggle="modal" data-bs-target="#confirmModal"
                                                    onclick="deleteConfirmModal(this)"><i class="bx bx-trash"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-original-title="Kitob turini oʻchirish"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{ $facultys->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
            <!--/ Facultys -->

            <!-- Departaments -->
            <div class="col-md-6 col-lg-4 col-xl-6 order-0 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                        <div class="card-title mb-0">
                            <strong class="m-0 me-2">Kafedralar</strong>
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0 text-violet-800" type="button" onclick="addDetail(this)"
                                data-title="Kafedra qoʻshish" data-type="10" data-bs-toggle="modal"
                                data-bs-target="#detailModal">
                                <i class="bx bx-message-square-add text-xl" data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-original-title="Kafedra qoʻshish"></i>
                            </button>
                        </div>
                    </div>
                    <hr class="mt-3">
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr class="uppercase">
                                        <th>№</th>
                                        <th>nomi</th>
                                        <th class="text-center">holati</th>
                                        <th>yaratuvchi</th>
                                        <th class="text-center">harakatlar</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($departaments as $i => $d)
                                        <tr>
                                            <td class="font-medium">{{ $i+1 }}</td>
                                            <td>{{ $d->$name }}</td>
                                            <td class="text-center">
                                                @if ($d->isActive)
                                                    <small class="badge bg-label-primary me-1" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" data-bs-original-title="Aktiv"> <i
                                                            class="bx bx-check-shield"></i></small>
                                                @else
                                                    <small class="badge bg-label-danger me-1" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" data-bs-original-title="Aktiv emas"><i
                                                            class="bx bx-shield-alt-2"></i></small>
                                                @endif
                                            </td>
                                            <td>{{ $d->user->name }}</td>
                                            <td class="text-center">
                                                <button type="button" class="px-2" onclick="updateDetail(this)"
                                                    data-type="1" data-title="Kitob tilini yangilash"
                                                    data-id="{{ $d->id }}" data-bs-toggle="modal"
                                                    data-bs-target="#detailModal"
                                                    data-langs="{{ $d->nameuz . '@' . $d->nameru . '@' . $d->nameen }}"><i
                                                        class="bx bx-edit" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        data-bs-original-title="Kitob tilini yangilash"></i></button>
                                                <button type="button"
                                                    data-href="{{ route('admin.datail.book.delete', $d->id) }}"
                                                    data-bs-toggle="modal" data-bs-target="#confirmModal"
                                                    onclick="deleteConfirmModal(this)"><i class="bx bx-trash"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-original-title="Kitob tilini oʻchirish"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{ $departaments->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
            <!--/ Departaments -->

            <!-- Groups -->
            <div class="col-md-6 col-lg-4 col-xl-6 order-0 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                        <div class="card-title mb-0">
                            <strong class="m-0 me-2">Guruhlar</strong>
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0 text-violet-800" type="button" onclick="addGroup(this)"
                                data-title="Guruh qoʻshish" data-bs-toggle="modal" data-bs-target="#groupModal">
                                <i class="bx bx-message-square-add text-xl" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-original-title="Guruh qoʻshish"></i>
                            </button>
                        </div>
                    </div>
                    <hr class="mt-3">
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr class="uppercase">
                                        <th>№</th>
                                        <th>nomi</th>
                                        <th class="text-center">holati</th>
                                        <th>yaratuvchi</th>
                                        <th class="text-center">harakatlar</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($groups as $i => $g)
                                        <tr>
                                            <td class="font-medium">{{ $i+1 }}</td>
                                            <td>{{ $g->group }}</td>
                                            <td class="text-center">
                                                @if ($g->isActive)
                                                    <small class="badge bg-label-primary me-1" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" data-bs-original-title="Aktiv"> <i
                                                            class="bx bx-check-shield"></i></small>
                                                @else
                                                    <small class="badge bg-label-danger me-1" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" data-bs-original-title="Aktiv emas"><i
                                                            class="bx bx-shield-alt-2"></i></small>
                                                @endif
                                            </td>
                                            <td>{{ $g->user->name }}</td>
                                            <td class="text-center">
                                                <button type="button" class="px-2" onclick="updateGroup(this)"
                                                    data-title="Gruruhni yangilash" data-id="{{ $g->id }}"
                                                    data-bs-toggle="modal" data-bs-target="#groupModal"
                                                    data-name="{{ $g->group }}"><i class="bx bx-edit"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-original-title="Gruruhni yangilash"></i></button>
                                                <button type="button"
                                                    data-href="{{ route('admin.system.delete', $g->id) }}"
                                                    data-bs-toggle="modal" data-bs-target="#confirmModal"
                                                    onclick="deleteConfirmModal(this)"><i class="bx bx-trash"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-original-title="Gruruhni oʻchirish"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{ $groups->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
            <!--/ Groups -->
        </div>

        <!-- Modal -->
        <div class="modal fade" id="detailModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="detailModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ route('admin.datail.book.add') }}" method="post" id="modalForm"
                        data-add="{{ route('admin.datail.book.add') }}"
                        data-update="{{ route('admin.datail.book.update') }}">
                        @csrf
                        <input type="number" name="type" hidden>
                        <input type="number" name="id" hidden>
                        <div class="modal-header">
                            <label class="modal-title form-label" id="titleDetail"></label>
                        </div>
                        <div class="modal-body">
                            <div class="col-12 fv-plugins-icon-container">
                                <div class="input-group input-group-merge mb-2">
                                    <input type="text" class="form-control" name="nameuz" placeholder="name uz"
                                        required data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip"
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
                                <div class="form-check">
                                    <label class="form-check-label custom-option-content" for="isActive">
                                        <span class="custom-option-body">
                                            <span class="custom-option-title"> Faolmi ? </span>
                                        </span>
                                        <input class="form-check-input" type="checkbox" name="isActiveCheck"
                                            id="isActive">
                                    </label>
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

        <div class="modal fade" id="groupModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="groupModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ route('admin.system.add') }}" method="post" id="modalFormGroup"
                        data-add="{{ route('admin.system.add') }}" data-update="{{ route('admin.system.update') }}">
                        @csrf
                        <input type="number" name="groupId" hidden>
                        <div class="modal-header">
                            <label class="modal-title form-label" id="titleGroup"></label>
                        </div>
                        <div class="modal-body">
                            <div class="col-12 fv-plugins-icon-container">
                                <div class="input-group input-group-merge mb-2">
                                    <select name="facultyId" class="form-select" required data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="majburiy boʻlim">
                                        @foreach ($facultys as $f)
                                            <option value="{{ $f->id }}">{{ $f->$name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-group input-group-merge mb-2">
                                    <select name="depId" class="form-select" required data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="majburiy boʻlim">
                                        @foreach ($departaments as $d)
                                            <option value="{{ $d->id }}">{{ $d->$name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-group input-group-merge mb-2">
                                    <input type="text" class="form-control" name="group" placeholder="Guruh nomi"
                                        required data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip"
                                        data-bs-placement="top" title="majburiy bo'lim">
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label custom-option-content" for="isActive">
                                        <span class="custom-option-body">
                                            <span class="custom-option-title"> Faolmi ? </span>
                                        </span>
                                        <input class="form-check-input" type="checkbox" name="isActiveCheck"
                                            id="isActive">
                                    </label>
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
