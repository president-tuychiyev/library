@extends('layouts.root')

@section('title', 'Bosh sahifa')

@section('content')

    @php($name = 'name' . app()->getLocale())

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Types -->
            <div class="col-md-6 col-lg-4 col-xl-6 order-0 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                        <div class="card-title mb-0">
                            <strong class="m-0 me-2">Turi</strong>
                        </div>
                        <button class="btn p-0 text-violet-800" type="button" onclick="addDetail(this)"
                            data-title="Kitob turini qoʻshish" data-type="1" data-bs-toggle="modal"
                            data-bs-target="#detailModal">
                            <i class="bx bx-message-square-add text-xl" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-original-title="Kitob turini qoʻshish"></i>
                        </button>
                    </div>
                    <hr class="mt-3">
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr class="uppercase">
                                        <th>id</th>
                                        <th>nomi</th>
                                        <th class="text-center">holati</th>
                                        <th>yaratuvchi</th>
                                        <th class="text-center">harakatlar</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($docTypes as $dt)
                                        <tr>
                                            <td class="font-medium">{{ $dt->id }}</td>
                                            <td>{{ $dt->$name }}</td>
                                            <td class="text-center">
                                                @if ($dt->isActive)
                                                    <small class="badge bg-label-primary me-1" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" data-bs-original-title="Aktiv"> <i
                                                            class="bx bx-check-shield"></i></small>
                                                @else
                                                    <small class="badge bg-label-danger me-1" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" data-bs-original-title="Aktiv emas"><i
                                                            class="bx bx-shield-alt-2"></i></small>
                                                @endif
                                            </td>
                                            <td>{{ $dt->user->name }}</td>
                                            <td class="text-center">
                                                <button type="button" class="px-2" onclick="updateDetail(this)"
                                                    data-type="1" data-title="Kitob turini yangilash"
                                                    data-id="{{ $dt->id }}" data-bs-toggle="modal"
                                                    data-bs-target="#detailModal"
                                                    data-langs="{{ $dt->nameuz . '@' . $dt->nameru . '@' . $dt->nameen }}"><i
                                                        class="bx bx-edit" data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-original-title="Kitob turini yangilash"></i></button>
                                                <button type="button"
                                                    data-href="{{ route('admin.datail.book.delete', $dt->id) }}"
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
                        {{ $docTypes->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
            <!--/ Types -->

            <!-- lang -->
            <div class="col-md-6 col-lg-4 col-xl-6 order-0 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                        <div class="card-title mb-0">
                            <strong class="m-0 me-2">Tili</strong>
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0 text-violet-800" type="button" onclick="addDetail(this)"
                                data-title="Kitob tilini qoʻshish" data-type="2" data-bs-toggle="modal"
                                data-bs-target="#detailModal">
                                <i class="bx bx-message-square-add text-xl" data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-original-title="Kitob tilini qoʻshish"></i>
                            </button>
                        </div>
                    </div>
                    <hr class="mt-3">
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr class="uppercase">
                                        <th>id</th>
                                        <th>nomi</th>
                                        <th class="text-center">holati</th>
                                        <th>yaratuvchi</th>
                                        <th class="text-center">harakatlar</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($docLangs as $dl)
                                        <tr>
                                            <td class="font-medium">{{ $dl->id }}</td>
                                            <td>{{ $dl->$name }}</td>
                                            <td class="text-center">
                                                @if ($dl->isActive)
                                                    <small class="badge bg-label-primary me-1" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" data-bs-original-title="Aktiv"> <i
                                                            class="bx bx-check-shield"></i></small>
                                                @else
                                                    <small class="badge bg-label-danger me-1" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" data-bs-original-title="Aktiv emas"><i
                                                            class="bx bx-shield-alt-2"></i></small>
                                                @endif
                                            </td>
                                            <td>{{ $dl->user->name }}</td>
                                            <td class="text-center">
                                                <button type="button" class="px-2" onclick="updateDetail(this)"
                                                    data-type="1" data-title="Kitob tilini yangilash"
                                                    data-id="{{ $dl->id }}" data-bs-toggle="modal"
                                                    data-bs-target="#detailModal"
                                                    data-langs="{{ $dl->nameuz . '@' . $dl->nameru . '@' . $dl->nameen }}"><i
                                                        class="bx bx-edit" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        data-bs-original-title="Kitob tilini yangilash"></i></button>
                                                <button type="button"
                                                    data-href="{{ route('admin.datail.book.delete', $dl->id) }}"
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
                        {{ $docLangs->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
            <!--/ Lang -->

            <!-- Text types -->
            <div class="col-md-6 col-lg-4 col-xl-6 order-0 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                        <div class="card-title mb-0">
                            <strong class="m-0 me-2">Kitob yozuvi</strong>
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0 text-violet-800" type="button" onclick="addDetail(this)"
                                data-title="Kitob yozuvini qoʻshish" data-type="3" data-bs-toggle="modal"
                                data-bs-target="#detailModal">
                                <i class="bx bx-message-square-add text-xl" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-original-title="Kitob yozuvini qoʻshish"></i>
                            </button>
                        </div>
                    </div>
                    <hr class="mt-3">
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr class="uppercase">
                                        <th>id</th>
                                        <th>nomi</th>
                                        <th class="text-center">holati</th>
                                        <th>yaratuvchi</th>
                                        <th class="text-center">harakatlar</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($textTypes as $tt)
                                        <tr>
                                            <td class="font-medium">{{ $tt->id }}</td>
                                            <td>{{ $tt->$name }}</td>
                                            <td class="text-center">
                                                @if ($tt->isActive)
                                                    <small class="badge bg-label-primary me-1" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" data-bs-original-title="Aktiv"> <i
                                                            class="bx bx-check-shield"></i></small>
                                                @else
                                                    <small class="badge bg-label-danger me-1" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" data-bs-original-title="Aktiv emas"><i
                                                            class="bx bx-shield-alt-2"></i></small>
                                                @endif
                                            </td>
                                            <td>{{ $tt->user->name }}</td>
                                            <td class="text-center">
                                                <button type="button" class="px-2" onclick="updateDetail(this)"
                                                    data-type="1" data-title="Kitob yozuvini yangilash"
                                                    data-id="{{ $tt->id }}" data-bs-toggle="modal"
                                                    data-bs-target="#detailModal"
                                                    data-langs="{{ $tt->nameuz . '@' . $tt->nameru . '@' . $tt->nameen }}"><i
                                                        class="bx bx-edit" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        data-bs-original-title="Kitob yozuvini yangilash"></i></button>
                                                <button type="button"
                                                    data-href="{{ route('admin.datail.book.delete', $tt->id) }}"
                                                    data-bs-toggle="modal" data-bs-target="#confirmModal"
                                                    onclick="deleteConfirmModal(this)"><i class="bx bx-trash"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-original-title="Kitob yozuvini oʻchirish"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{ $textTypes->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
            <!--/ Text types -->

            <!-- Document formats -->
            <div class="col-md-6 col-lg-4 col-xl-6 order-0 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                        <div class="card-title mb-0">
                            <strong class="m-0 me-2">Matn turi</strong>
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0 text-violet-800" type="button" onclick="addDetail(this)"
                                data-title="Matn turini qoʻshish" data-type="4" data-bs-toggle="modal"
                                data-bs-target="#detailModal">
                                <i class="bx bx-message-square-add text-xl" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-original-title="Matn turini qoʻshish"></i>
                            </button>
                        </div>
                    </div>
                    <hr class="mt-3">
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr class="uppercase">
                                        <th>id</th>
                                        <th>nomi</th>
                                        <th class="text-center">holati</th>
                                        <th>yaratuvchi</th>
                                        <th class="text-center">harakatlar</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($docFormats as $df)
                                        <tr>
                                            <td class="font-medium">{{ $df->id }}</td>
                                            <td>{{ $df->$name }}</td>
                                            <td class="text-center">
                                                @if ($df->isActive)
                                                    <small class="badge bg-label-primary me-1" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" data-bs-original-title="Aktiv"> <i
                                                            class="bx bx-check-shield"></i></small>
                                                @else
                                                    <small class="badge bg-label-danger me-1" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" data-bs-original-title="Aktiv emas"><i
                                                            class="bx bx-shield-alt-2"></i></small>
                                                @endif
                                            </td>
                                            <td>{{ $df->user->name }}</td>
                                            <td class="text-center">
                                                <button type="button" class="px-2" onclick="updateDetail(this)"
                                                    data-type="1" data-title="Matn turini yangilash"
                                                    data-id="{{ $df->id }}" data-bs-toggle="modal"
                                                    data-bs-target="#detailModal"
                                                    data-langs="{{ $df->nameuz . '@' . $df->nameru . '@' . $df->nameen }}"><i
                                                        class="bx bx-edit" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        data-bs-original-title="Matn turini yangilash"></i></button>
                                                <button type="button"
                                                    data-href="{{ route('admin.datail.book.delete', $df->id) }}"
                                                    data-bs-toggle="modal" data-bs-target="#confirmModal"
                                                    onclick="deleteConfirmModal(this)"><i class="bx bx-trash"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-original-title="Matn turini oʻchirish"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{ $docFormats->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
            <!--/  Document formats -->

            <!-- Fayl types -->
            <div class="col-md-6 col-lg-4 col-xl-6 order-0 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                        <div class="card-title mb-0">
                            <strong class="m-0 me-2">Fayl turi</strong>
                        </div>
                        <button class="btn p-0 text-violet-800" type="button" onclick="addDetail(this)"
                            data-title="Fayl turini qoʻshish" data-type="5" data-bs-toggle="modal"
                            data-bs-target="#detailModal">
                            <i class="bx bx-message-square-add text-xl" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-original-title="Fayl turini qoʻshish"></i>
                        </button>
                    </div>
                    <hr class="mt-3">
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr class="uppercase">
                                        <th>id</th>
                                        <th>nomi</th>
                                        <th class="text-center">holati</th>
                                        <th>yaratuvchi</th>
                                        <th class="text-center">harakatlar</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($fileTypes as $ft)
                                        <tr>
                                            <td class="font-medium">{{ $ft->id }}</td>
                                            <td>{{ $ft->$name }}</td>
                                            <td class="text-center">
                                                @if ($ft->isActive)
                                                    <small class="badge bg-label-primary me-1" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" data-bs-original-title="Aktiv"> <i
                                                            class="bx bx-check-shield"></i></small>
                                                @else
                                                    <small class="badge bg-label-danger me-1" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" data-bs-original-title="Aktiv emas"><i
                                                            class="bx bx-shield-alt-2"></i></small>
                                                @endif
                                            </td>
                                            <td>{{ $ft->user->name }}</td>
                                            <td class="text-center">
                                                <button type="button" class="px-2" onclick="updateDetail(this)"
                                                    data-type="1" data-title="Fayl turini yangilash"
                                                    data-id="{{ $ft->id }}" data-bs-toggle="modal"
                                                    data-bs-target="#detailModal"
                                                    data-langs="{{ $ft->nameuz . '@' . $ft->nameru . '@' . $ft->nameen }}"><i
                                                        class="bx bx-edit" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        data-bs-original-title="Fayl turini qoʻshish"></i></button>
                                                <button type="button"
                                                    data-href="{{ route('admin.datail.book.delete', $ft->id) }}"
                                                    data-bs-toggle="modal" data-bs-target="#confirmModal"
                                                    onclick="deleteConfirmModal(this)"><i class="bx bx-trash"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-original-title="Fayl turini oʻchirish"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{ $fileTypes->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
            <!--/  Fayl types -->

            <!-- Directs -->
            <div class="col-md-6 col-lg-4 col-xl-6 order-0 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                        <div class="card-title mb-0">
                            <strong class="m-0 me-2">Fan yoʻnalish</strong>
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0 text-violet-800" type="button" onclick="addDetail(this)"
                                data-title="Fan yoʻnalishini qoʻshish" data-type="6" data-bs-toggle="modal"
                                data-bs-target="#detailModal">
                                <i class="bx bx-message-square-add text-xl" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-original-title="Fan yoʻnalishini qoʻshish"></i>
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
                                    @foreach ($directs as $i => $d)
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
                                                    data-type="1" data-title="Fan yoʻnalishini yangilash"
                                                    data-id="{{ $d->id }}" data-bs-toggle="modal"
                                                    data-bs-target="#detailModal"
                                                    data-langs="{{ $d->nameuz . '@' . $d->nameru . '@' . $d->nameen }}"><i
                                                        class="bx bx-edit" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        data-bs-original-title="Fan yoʻnalishini yangilash"></i></button>
                                                <button type="button"
                                                    data-href="{{ route('admin.datail.book.delete', $d->id) }}"
                                                    data-bs-toggle="modal" data-bs-target="#confirmModal"
                                                    onclick="deleteConfirmModal(this)"><i class="bx bx-trash"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-original-title="Fan yoʻnalishini oʻchirish"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{ $directs->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
            <!--/  Directs -->
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
                                <div class="input-group input-group-merge has-validation mb-2">
                                    <input type="text" class="form-control" name="nameuz" placeholder="name uz"
                                        required data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip"
                                        data-bs-placement="top" title="majburiy bo'lim">
                                </div>
                                <div class="input-group input-group-merge has-validation mb-2">
                                    <input type="text" class="form-control" name="nameru" placeholder="name ru"
                                        required data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip"
                                        data-bs-placement="top" title="majburiy bo'lim">
                                </div>
                                <div class="input-group input-group-merge has-validation mb-2">
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
        <!--/ Modal for add data -->
    </div>

@stop
