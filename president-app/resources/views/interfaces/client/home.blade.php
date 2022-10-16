@extends('layouts.root')

@section('title', 'Bosh sahifa')



@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="col-xl-12">
            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#received-book" aria-controls="received-book" aria-selected="false"><i
                                class="bx bx-user-plus"></i> Kitob olganlar </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#returned-book" aria-controls="returned-book" aria-selected="false"><i
                                class="bx bx-user-check"></i> Qaytarganlar</button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#expirde-back-book" aria-controls="expirde-back-book" aria-selected="true"><i
                                class="bx bx-user-minus"></i> Muddati o'tganlar</button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="received-book" role="tabpanel">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-hover" id="my-datatable">
                                <thead>
                                    <tr class="text-center">
                                        <th>№</th>
                                        <th>F.I.O</th>
                                        <th>Kitob nomi</th>
                                        <th>Muqova</th>
                                        <th>Holati</th>
                                        <th>Berilgan sana</th>
                                        <th>Qayatrish sanasi</th>
                                        <th>Harakatlar</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($orders as $i => $o)
                                        @if ($o->status == 1)
                                            <tr class="text-center">
                                                <td><strong>{{ $i + 1 }}</strong></td>
                                                <td>{{ $o->recUser->name }}</td>
                                                <td>{{ $o->book->name }}</td>
                                                <td><img class="rounded" style="width: 8ex"
                                                        src="{{ asset($o->book->cover->fullPath) }}" alt="#"></td>
                                                </td>
                                                <td>
                                                    <span class="badge bg-label-primary uppercase">olingan</span>
                                                </td>
                                                <td>{{ $o->created_at->format('d.m.Y') }}</td>
                                                <td>{{ date('d.m.Y', strtotime($o->getBack)) }}</td>
                                                <td>
                                                    <button type="button" data-bs-toggle="modal"
                                                        data-bs-target="#infoModal"
                                                        onclick="infoUser({{ $o->recUserId }})"><i class="bx bx-show"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            data-bs-original-title="Ko'rish"></i></button>
                                                    <a href="{{ route('admin.orders.update', ['id' => $o->id, 'status' => 2]) }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-original-title="Holatni qaytarilgan qilib o'zgartirish"><i
                                                            class="bx bx-user-check"></i></a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="returned-book" role="tabpanel">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="text-center">
                                        <th>№</th>
                                        <th>F.I.O</th>
                                        <th>Kitob nomi</th>
                                        <th>Muqova</th>
                                        <th>Holati</th>
                                        <th>Berilgan sana</th>
                                        <th>Qayatrish sanasi</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($orders as $i => $o)
                                        @if ($o->status == 2)
                                            <tr class="text-center">
                                                <td><strong>{{ $i + 1 }}</strong></td>
                                                <td>{{ $o->recUser->name }}</td>
                                                <td>{{ $o->book->name }}</td>
                                                <td><img class="rounded" style="width: 8ex"
                                                        src="{{ asset($o->book->cover->fullPath) }}" alt="#"></td>
                                                </td>
                                                <td>
                                                    <span class="badge bg-label-success uppercase">qaytarilgan</span>
                                                </td>
                                                <td>{{ $o->created_at->format('d.m.Y') }}</td>
                                                <td>{{ date('d.m.Y', strtotime($o->getBack)) }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade mb-3" id="expirde-back-book" role="tabpanel">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="text-center">
                                        <th>№</th>
                                        <th>F.I.O</th>
                                        <th>Kitob nomi</th>
                                        <th>Muqova</th>
                                        <th>Holati</th>
                                        <th>Berilgan sana</th>
                                        <th>Qayatrish sanasi</th>
                                        <th>Harakatlar</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($orders as $i => $o)
                                        @if ($o->status == 3)
                                            <tr class="text-center">
                                                <td><strong>{{ $i + 1 }}</strong></td>
                                                <td>{{ $o->recUser->name }}</td>
                                                <td>{{ $o->book->name }}</td>
                                                <td><img class="rounded" style="width: 8ex"
                                                        src="{{ asset($o->book->cover->fullPath) }}" alt="#"></td>
                                                </td>
                                                <td>
                                                    <span class="badge bg-label-danger uppercase">muddati o'tgan</span>
                                                </td>
                                                <td>{{ $o->created_at->format('d.m.Y') }}</td>
                                                <td>{{ date('d.m.Y', strtotime($o->getBack)) }}</td>
                                                <td>
                                                    <button type="button" data-bs-toggle="modal"
                                                        data-bs-target="#infoModal"
                                                        onclick="infoUser({{ $o->recUserId }})"><i class="bx bx-show"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            data-bs-original-title="Ko'rish"></i></button>
                                                    <a href="{{ route('admin.orders.update', ['id' => $o->id, 'status' => 2]) }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-original-title="Holatni qaytarilgan qilib o'zgartirish"><i
                                                            class="bx bx-user-check"></i></a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{ $orders->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>

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
                                            id="phone-info-modal">+998 94 4337566</span></p>
                                    <span class="badge bg-label-primary">Jami o'qilgan kitoblar soni: <span
                                            id="books-info-modal">125</span> dona</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger bg-red-600" data-bs-dismiss="modal">Orqaga</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
