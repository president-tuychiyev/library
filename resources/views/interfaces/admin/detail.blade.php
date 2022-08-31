@extends('layouts.root')

@section('title', 'Bosh sahifa')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Types -->
            <div class="col-md-6 col-lg-4 col-xl-6 order-0 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                        <div class="card-title mb-0">
                            <strong class="m-0 me-2">Turi</strong>
                        </div>
                        <button class="btn p-0 text-violet-800" type="button" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">
                            <i class="bx bx-message-square-add"></i>
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
                                        <th>holati</th>
                                        <th>yaratuvchi</th>
                                        <th>harakatlar</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($docTypes as $dt)
                                        <tr>
                                            <td class="font-medium">{{ $dt->id }}</td>
                                            <td>{{ $dt->name }}</td>
                                            <td>
                                                @if ($dt->isActive)
                                                    <small class="badge bg-label-primary me-1"> <i
                                                            class="bx bx-check-shield"></i></small>
                                                @else
                                                    <small class="badge bg-label-danger me-1"><i
                                                            class="bx bx-shield-alt-2"></i></small>
                                                @endif
                                            </td>
                                            <td>{{ $dt->username }}</td>
                                            <td>
                                                <a class="px-2" href="javascript:void(0);"><i
                                                        class="bx bx-edit-alt"></i></a>
                                                <a href="javascript:void(0);"><i class="bx bx-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                            {{ $docTypes->links() }}
                        </div>
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
                            <button class="btn p-0 text-violet-800" type="button">
                                <i class="bx bx-message-square-add"></i>
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
                                        <th>holati</th>
                                        <th>yaratuvchi</th>
                                        <th>harakatlar</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($docLangs as $dl)
                                        <tr>
                                            <td class="font-medium">{{ $dt->id }}</td>
                                            <td>{{ $dt->name }}</td>
                                            <td>
                                                @if ($dt->isActive)
                                                    <small class="badge bg-label-primary me-1"> <i
                                                            class="bx bx-check-shield"></i></small>
                                                @else
                                                    <small class="badge bg-label-danger me-1"><i
                                                            class="bx bx-shield-alt-2"></i></small>
                                                @endif
                                            </td>
                                            <td>{{ $dt->username }}</td>
                                            <td>
                                                <a class="px-2" href="javascript:void(0);"><i
                                                        class="bx bx-edit-alt"></i></a>
                                                <a href="javascript:void(0);"><i class="bx bx-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
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
                            <button class="btn p-0 text-violet-800" type="button">
                                <i class="bx bx-message-square-add"></i>
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
                                        <th>holati</th>
                                        <th>yaratuvchi</th>
                                        <th>harakatlar</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($textTypes as $tt)
                                        <tr>
                                            <td class="font-medium">{{ $tt->id }}</td>
                                            <td>{{ $tt->name }}</td>
                                            <td>
                                                @if ($dt->isActive)
                                                    <small class="badge bg-label-primary me-1"> <i
                                                            class="bx bx-check-shield"></i></small>
                                                @else
                                                    <small class="badge bg-label-danger me-1"><i
                                                            class="bx bx-shield-alt-2"></i></small>
                                                @endif
                                            </td>
                                            <td>{{ $tt->username }}</td>
                                            <td>
                                                <a class="px-2" href="javascript:void(0);"><i
                                                        class="bx bx-edit-alt"></i></a>
                                                <a href="javascript:void(0);"><i class="bx bx-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
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
                            <button class="btn p-0 text-violet-800" type="button">
                                <i class="bx bx-message-square-add"></i>
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
                                        <th>holati</th>
                                        <th>yaratuvchi</th>
                                        <th>harakatlar</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($docFormats as $df)
                                        <tr>
                                            <td class="font-medium">{{ $df->id }}</td>
                                            <td>{{ $df->name }}</td>
                                            <td>
                                                @if ($df->isActive)
                                                    <small class="badge bg-label-primary me-1"> <i
                                                            class="bx bx-check-shield"></i></small>
                                                @else
                                                    <small class="badge bg-label-danger me-1"><i
                                                            class="bx bx-shield-alt-2"></i></small>
                                                @endif
                                            </td>
                                            <td>{{ $df->username }}</td>
                                            <td>
                                                <a class="px-2" href="javascript:void(0);"><i
                                                        class="bx bx-edit-alt"></i></a>
                                                <a href="javascript:void(0);"><i class="bx bx-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
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
                        <button class="btn p-0 text-violet-800" type="button">
                            <i class="bx bx-message-square-add"></i>
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
                                        <th>holati</th>
                                        <th>yaratuvchi</th>
                                        <th>harakatlar</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($fileTypes as $ft)
                                        <tr>
                                            <td class="font-medium">{{ $ft->id }}</td>
                                            <td>{{ $ft->name }}</td>
                                            <td>
                                                @if ($df->isActive)
                                                    <small class="badge bg-label-primary me-1"> <i
                                                            class="bx bx-check-shield"></i></small>
                                                @else
                                                    <small class="badge bg-label-danger me-1"><i
                                                            class="bx bx-shield-alt-2"></i></small>
                                                @endif
                                            </td>
                                            <td>{{ $ft->username }}</td>
                                            <td>
                                                <a class="px-2" href="javascript:void(0);"><i
                                                        class="bx bx-edit-alt"></i></a>
                                                <a href="javascript:void(0);"><i class="bx bx-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--/  Fayl types -->

            <!-- Directs -->
            <div class="col-md-6 col-lg-4 col-xl-6 order-0 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                        <div class="card-title mb-0">
                            <strong class="m-0 me-2">Fan yo'nalish</strong>
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0 text-violet-800" type="button">
                                <i class="bx bx-message-square-add"></i>
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
                                        <th>holati</th>
                                        <th>yaratuvchi</th>
                                        <th>harakatlar</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($directs as $d)
                                        <tr>
                                            <td class="font-medium">{{ $d->id }}</td>
                                            <td>{{ $d->name }}</td>
                                            <td>
                                                @if ($d->isActive)
                                                    <small class="badge bg-label-primary me-1"> <i
                                                            class="bx bx-check-shield"></i></small>
                                                @else
                                                    <small class="badge bg-label-danger me-1"><i
                                                            class="bx bx-shield-alt-2"></i></small>
                                                @endif
                                            </td>
                                            <td>{{ $d->username }}</td>
                                            <td>
                                                <a class="px-2" href="javascript:void(0);"><i
                                                        class="bx bx-edit-alt"></i></a>
                                                <a href="javascript:void(0);"><i class="bx bx-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--/  Directs -->
        </div>


        <!-- Modal for add data -->
        {{-- <div class="modal-dialog modal-dialog-centered" id="staticBackdrop">
            <form class="row g-3 fv-plugins-framework" action="{{ route('admin.datail.book.add') }}" method="POST">
                @csrf
                <input type="number" min="1" max="12" maxlength="2" name="type" value="1"
                    hidden>
                <div class="col-12 fv-plugins-icon-container">
                    <label class="form-label">Phone Number</label>
                    <div class="input-group input-group-merge has-validation mb-2">
                        <input type="text" class="form-control" name="nameuz" placeholder="name uz">
                    </div>
                    <div class="input-group input-group-merge has-validation mb-2">
                        <input type="text" class="form-control" name="nameru" placeholder="name ru">
                    </div>
                    <div class="input-group input-group-merge has-validation mb-2">
                        <input type="text" class="form-control" name="nameen" placeholder="name en">
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
                <div class="col-12">
                    <button type="submit" class="btn btn-primary me-sm-3 me-1 bg-violet-600">Qo'shish</button>
                    <button type="button" class="btn btn-danger bg-red-600">Bekor qilish</button>
                </div>
            </form>
        </div> --}}

        <!-- Button trigger modal -->

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ route('admin.datail.book.add') }}" method="post">
                        @csrf
                        <input type="number" min="1" max="12" maxlength="2" name="type"
                            value="1" hidden>
                        <div class="modal-header">
                            <label class="modal-title form-label">Phone Number</label>
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
                                            id="isActive" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip"
                                            data-bs-placement="top" title="majburiy emas">
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger bg-red-600" data-bs-dismiss="modal">Bekor
                                qilish</button>
                            <button type="submit" class="btn btn-primary bg-blue-800">Qo'shish</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--/ Modal for add data -->


    </div>
@stop
