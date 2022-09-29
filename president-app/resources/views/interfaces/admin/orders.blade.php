@extends('layouts.root')

@section('title', 'Kitb olish & berish')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-sm-row mb-4">
                    <li class="nav-item mr-2">
                        <a href="#" class="nav-link active">
                            <i class="bx bx bx-user-plus"></i>
                            Olingan
                        </a>
                    </li>
                    <li class="nav-item mr-2">
                        <a href="#" class="nav-link active !bg-rose-600">
                            <i class="bx bx bx-user-minus"></i>
                            Qarzdorlar
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link active !bg-indigo-700">
                            <i class="bx bx bx-user-check"></i>
                            Qaytarilgan
                        </a>
                    </li>
                </ul>
            </div>
        </div>




        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                <div class="card-title mb-0">
                    <strong class="m-0 me-2">
                        Titlesi
                    </strong>
                </div>
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
                                <th>holati</th>
                                <th>yaratuvchi</th>
                                <th>yaratilgan sana</th>
                                <th>harakatlar</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($books as $i => $b)
                                <tr class="text-center">
                                    <td><strong>{{ $i + 1 }}</strong></td>
                                    <td>{{ $b->name }}</td>
                                    <td><img class="rounded-circle" style="width: 8ex"
                                            src="{{ asset($b->media->fullPath) }}" alt="{{ $b->name }}"></td>
                                    <td>
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
                                    <td>{{ $b->user->name }}</td>
                                    <td>{{ $b->created_at->format('d.m.Y') }}</td>
                                    <td>
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
