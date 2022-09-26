@extends('layouts.root')

@section('title', 'Mualliflar')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                <div class="card-title mb-0">
                    <strong class="m-0 me-2">Mualliflar</strong>
                </div>
                <button class="btn p-0 text-violet-800" type="button" onclick="addAuthor(this)" data-title="Muallif qoʻshish"
                    data-bs-toggle="modal" data-bs-target="#authorModal">
                    <i class="bx bx-message-square-add text-xl" data-bs-toggle="tooltip" data-bs-placement="top"
                        data-bs-original-title="Muallif qoʻshish"></i>
                </button>
            </div>
            <hr class="mt-3">
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>№</th>
                                <th>nomi</th>
                                <th class="text-center">holati</th>
                                <th>yaratuvchi</th>
                                <th>yaratilgan sana</th>
                                <th class="text-center">harakatlar</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($authors as $i => $a)
                                <tr>
                                    <td><strong>{{ $i+1 }}</strong></td>
                                    <td>{{ $a->name }}</td>
                                    <td class="text-center">
                                        @if ($a->isActive)
                                            <small class="badge bg-label-primary me-1"> <i class="bx bx-check-shield"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-original-title="Aktiv"></i></small>
                                        @else
                                            <small class="badge bg-label-danger me-1"><i class="bx bx-shield-alt-2"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-original-title="Aktiv emas"></i></small>
                                        @endif
                                    </td>
                                    <td>{{ $a->user->name }}</td>
                                    <td>{{ $a->created_at->format('d.m.Y') }}</td>
                                    <td class="text-center">
                                        <button type="button" class="px-2" onclick="updateAuthor(this)"
                                            data-title="Muallifni yangilash" data-id="{{ $a->id }}"
                                            data-bs-toggle="modal" data-bs-target="#authorModal"
                                            data-name="{{ $a->name }}"><i class="bx bx-edit" data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                data-bs-original-title="Muallifni yangilash"></i></button>
                                        <button type="button" data-href="{{ route('admin.authors.delete', $a->id) }}"
                                            data-bs-toggle="modal" data-bs-target="#confirmModal"
                                            onclick="deleteConfirmModal(this)"><i class="bx bx-trash"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-original-title="Muallifni oʻchirish"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                {{ $authors->links('pagination::bootstrap-5') }}
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="authorModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="authorModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ route('admin.authors.add') }}" method="post" id="modalForm"
                        data-add="{{ route('admin.authors.add') }}" data-update="{{ route('admin.authors.update') }}">
                        @csrf
                        <input type="number" name="id" hidden>
                        <div class="modal-header">
                            <label class="modal-title form-label" id="titleAuthor"></label>
                        </div>
                        <div class="modal-body">
                            <div class="col-12 fv-plugins-icon-container">
                                <div class="input-group input-group-merge has-validation mb-2">
                                    <input type="text" class="form-control" name="name"
                                        placeholder="To'liq ism familiyasi" required data-bs-toggle="tooltip"
                                        data-bs-custom-class="custom-tooltip" data-bs-placement="top"
                                        title="majburiy bo'lim">
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label custom-option-content" for="isActive">
                                        <span class="custom-option-body">
                                            <span class="custom-option-title"> Faolmi ? </span>
                                        </span>
                                        <input class="form-check-input" type="checkbox" name="isActiveCheck" id="isActive">
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
