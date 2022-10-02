@extends('layouts.root')

@section('title', 'Kitoblar')

@section('search')
    <form action="{{ route('admin.books.search') }}" method="get">
        <input type="text" class="form-control border-0 shadow-none" name="q" placeholder="Kitob qidirish..."
            aria-label="Kitob qidirish...">
    </form>
@stop

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                <div class="card-title mb-0">
                    <strong class="m-0 me-2">Kitoblar</strong>
                </div>
                <a href="{{ route('admin.books.add') }}" class="btn p-0 text-violet-800">
                    <i class="bx bx-message-square-add text-xl" data-bs-toggle="tooltip" data-bs-placement="top"
                        data-bs-original-title="Kitob qoʻshish"></i>
                </a>
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
                                <th>QRCODE</th>
                                <th>yaratuvchi</th>
                                <th>yaratilgan sana</th>
                                <th class="text-center">harakatlar</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($books as $i => $b)
                                <tr>
                                    <td><strong>{{ $i+1 }}</strong></td>
                                    <td>{{ $b->name }}</td>
                                    <td class="text-center">
                                        @if ($b->isActive)
                                            <small class="badge bg-label-primary me-1"> <i class="bx bx-check-shield"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-original-title="Aktiv"></i></small>
                                        @else
                                            <small class="badge bg-label-danger me-1"><i class="bx bx-shield-alt-2"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-original-title="Aktiv emas"></i></small>
                                        @endif
                                    </td>
                                    <td>{!! DNS2D::getBarcodeSVG((string) $b->id, 'QRCODE') !!}</td>
                                    <td>{{ $b->user->name }}</td>
                                    <td>{{ $b->created_at->format('d.m.Y') }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.books.view', $b->id) }}"><i class="bx bx-show me-1"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-original-title="Kitobni koʻrish"></i></a>
                                        <a href="{{ route('admin.books.select', $b->id) }}"><i class="bx bx-edit me-1"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-original-title="Kitobni yangilash"></i></a>
                                        <button type="button" data-href="{{ route('admin.books.delete', $b->id) }}"
                                            data-bs-toggle="modal" data-bs-target="#confirmModal"
                                            onclick="deleteConfirmModal(this)"><i class="bx bx-trash me-1"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-original-title="Kitobni oʻchirish"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                {{ $books->links('pagination::bootstrap-5') }}
            </div>
        </div>

    </div>
@stop
