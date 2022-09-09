@extends('layouts.root')

@section('title', 'Kitob')

@section('content')
    @php( $name = 'name' . app()->getLocale())

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl-12 mb-4 text-center">
                <div class="card">
                    <div class="card-body uppercase">
                        {{ $book->name }}
                    </div>
                </div>
            </div>

            <div class="col-xl-6 mb-4 mb-xl-0">
                <div class="card">
                    <div class="card-body">
                        <img src="{{ asset($book->cover->fullPath) }}" alt="">
                        <ul class="timeline">

                            <li class="timeline-item timeline-item-transparent">
                                <span class="timeline-point timeline-point-primary"></span>
                                <div class="timeline-event">
                                    <div class="timeline-header border-bottom">
                                        <strong>Yaratuvchi:</strong>
                                        <h6 class="mb-0">{{ $book->user->name }}</h6>
                                    </div>
                                </div>
                            </li>

                            <li class="timeline-item timeline-item-transparent">
                                <span class="timeline-point timeline-point-info"></span>
                                <div class="timeline-event">
                                    <div class="timeline-header border-bottom">
                                        <strong>Yaratilgan sana:</strong>
                                        <h6 class="mb-0">{{ $book->created_at->format('d.m.Y') }}</h6>
                                    </div>
                                </div>
                            </li>

                            <li class="timeline-item timeline-item-transparent">
                                <span class="timeline-point timeline-point-success"></span>
                                <div class="timeline-event">
                                    <div class="timeline-header border-bottom">
                                        <strong>Yangilangan sana:</strong>
                                        <h6 class="mb-0">{{ $book->updated_at->format('d.m.Y') }}</h6>
                                    </div>
                                </div>
                            </li>

                            <li class="timeline-item timeline-item-transparent">
                                <span class="timeline-point timeline-point-warning"></span>
                                <div class="timeline-event">
                                    <div class="timeline-header border-bottom">
                                        <strong>Holati:</strong>
                                        <h6 class="mb-0">
                                            @if ($book->isActive)
                                                <span class="badge badge-center bg-success"><i
                                                        class="bx bx-check-shield"></i></span> Aktiv
                                            @else
                                                <span class="badge badge-center bg-danger"><i
                                                        class="bx bx-shield"></i></span>Aktiv emas
                                            @endif
                                        </h6>
                                    </div>
                                </div>
                            </li>

                            <li class="timeline-item timeline-item-transparent">
                                <span class="timeline-point timeline-point-danger"></span>
                                <div class="timeline-event">
                                    <div class="timeline-header border-bottom">
                                        <strong>UDK:</strong>
                                        <span class="badge bg-label-primary uppercase">{{ $book->udk }}</span>
                                    </div>
                                </div>
                            </li>

                            <li class="timeline-item timeline-item-transparent">
                                <span class="timeline-point timeline-point-primary"></span>
                                <div class="timeline-event">
                                    <div class="timeline-header border-bottom">
                                        <strong>ISBN:</strong>
                                        <h6 class="mb-0">
                                            <span class="badge bg-label-primary uppercase">{{ $book->isbn }}</span>
                                        </h6>
                                    </div>
                                </div>
                            </li>

                            <li class="timeline-end-indicator">
                                <i class="bx bx-check-circle"></i>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card mt-5">
                    <form action="{{ route('admin.books.give') }}" method="post">
                        @csrf
                        <input type="number" name="bookId" value="{{ $book->id }}" hidden>
                        <div class="card-header">
                            <h5 class="card-title">Kitob berish</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="group">Guruh</label>
                                <select id="group" name="group" class="form-select" required data-bs-toggle="tooltip" data-bs-placement="top"
                                title="majburiy boʻlim">
                                @foreach ($groups as $g)
                                    <option value="{{ $g->id }}">{{ $g->group }}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="full-name">To'liq ism familiya</label>
                                <input type="text" id="full-name" name="name" class="form-control" required data-bs-toggle="tooltip" data-bs-placement="top"
                                title="majburiy boʻlim">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="card-number">Kutbhona karta raqami</label>
                                <input type="text" id="card-number" name="libCardNum" class="form-control" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="majburiy emas">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="phone-number">Telefon raqam</label>
                                <div class="input-group">
                                    <span class="input-group-text">UZ (+998)</span>
                                    <input type="number" id="phone-number-mask" name="phone" class="form-control phone-number-mask"
                                        placeholder="9* *** ****" required data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="majburiy boʻlim">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="issued">Berilgan sana</label>
                                <input type="date" id="issued" name="issued" class="form-control"
                                    value="{{ date('Y-m-d', strtotime(now())) }}" required data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="majburiy boʻlim">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="phone-number">Necha kunga</label>
                                <div class="input-group">
                                    <input type="number" id="get-back" name="day" class="form-control" required data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="majburiy boʻlim">
                                    <span class="input-group-text">kun</span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary bg-indigo-600">
                                <i class="bx bx-plus"></i>
                                <span class="align-middle">Kitobni berish</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="card">
                    <h5 class="card-header font-semibold">Kitob haqida ma'lumot</h5>
                    <div class="card-body">
                        <ul class="timeline timeline-dashed mt-3">
                            <li class="timeline-item timeline-item-warning mb-4">
                                <span class="timeline-indicator timeline-indicator-warning">
                                    <i class="bx bx-menu-alt-right"></i>
                                </span>
                                <div class="timeline-event">
                                    <div class="timeline-header border-bottom mb-3">
                                        <h6 class="mb-0">Anontatsiya</h6>
                                    </div>
                                    <div class="d-flex justify-content-between flex-wrap mb-2">
                                        <div>
                                            <span>{{ $book->annontation }}</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item timeline-item-primary mb-4">
                                <span class="timeline-indicator timeline-indicator-primary">
                                    <i class="bx bx-menu-alt-right"></i>
                                </span>
                                <div class="timeline-event">
                                    <div class="timeline-header border-bottom mb-3">
                                        <h6 class="mb-0">Mualiflar</h6>
                                    </div>
                                    <div class="d-flex justify-content-between flex-wrap mb-2">
                                        <div>
                                            <span>{{ $book->author->name }}</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item timeline-item-info mb-4">
                                <span class="timeline-indicator timeline-indicator-info">
                                    <i class="bx bx-menu-alt-right"></i>
                                </span>
                                <div class="timeline-event">
                                    <div class="timeline-header border-bottom mb-3">
                                        <h6 class="mb-0">Kitob turi</h6>
                                    </div>
                                    <div class="d-flex justify-content-between flex-wrap mb-2">
                                        <div>
                                            <span>{{ $book->type->$name }}</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item timeline-item-success mb-4">
                                <span class="timeline-indicator timeline-indicator-success">
                                    <i class="bx bx-menu-alt-right"></i>
                                </span>
                                <div class="timeline-event">
                                    <div class="timeline-header border-bottom mb-3">
                                        <h6 class="mb-0">Kitob tili</h6>
                                    </div>
                                    <div class="d-flex justify-content-between flex-wrap mb-2">
                                        <div>
                                            <span>{{ $book->lang->$name }}</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item timeline-item-warning mb-4">
                                <span class="timeline-indicator timeline-indicator-warning">
                                    <i class="bx bx-menu-alt-right"></i>
                                </span>
                                <div class="timeline-event">
                                    <div class="timeline-header border-bottom mb-3">
                                        <h6 class="mb-0">Kitob yozuvi</h6>
                                    </div>
                                    <div class="d-flex justify-content-between flex-wrap mb-2">
                                        <div>
                                            <span>{{ $book->text->$name }}</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item timeline-item-danger mb-4">
                                <span class="timeline-indicator timeline-indicator-danger">
                                    <i class="bx bx-menu-alt-right"></i>
                                </span>
                                <div class="timeline-event">
                                    <div class="timeline-header border-bottom mb-3">
                                        <h6 class="mb-0">Matn turi</h6>
                                    </div>
                                    <div class="d-flex justify-content-between flex-wrap mb-2">
                                        <div>
                                            <span>{{ $book->format->$name }}</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item timeline-item-primary mb-4">
                                <span class="timeline-indicator timeline-indicator-primary">
                                    <i class="bx bx-menu-alt-right"></i>
                                </span>
                                <div class="timeline-event">
                                    <div class="timeline-header border-bottom mb-3">
                                        <h6 class="mb-0">Fayl turi</h6>
                                    </div>
                                    <div class="d-flex justify-content-between flex-wrap mb-2">
                                        <div>
                                            <span>{{ $book->file->$name }}</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item timeline-item-info mb-4">
                                <span class="timeline-indicator timeline-indicator-info">
                                    <i class="bx bx-menu-alt-right"></i>
                                </span>
                                <div class="timeline-event">
                                    <div class="timeline-header border-bottom mb-3">
                                        <h6 class="mb-0">Fan yoʻnalishi</h6>
                                    </div>
                                    <div class="d-flex justify-content-between flex-wrap mb-2">
                                        <div>
                                            <span>{{ $book->direct->$name }}</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item timeline-item-success mb-4">
                                <span class="timeline-indicator timeline-indicator-success">
                                    <i class="bx bx-menu-alt-right"></i>
                                </span>
                                <div class="timeline-event">
                                    <div class="timeline-header border-bottom mb-3">
                                        <h6 class="mb-0">Betlar soni</h6>
                                    </div>
                                    <div class="d-flex justify-content-between flex-wrap mb-2">
                                        <div>
                                            <span>{{ $book->numPage }}</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item timeline-item-warning mb-4">
                                <span class="timeline-indicator timeline-indicator-warning">
                                    <i class="bx bx-menu-alt-right"></i>
                                </span>
                                <div class="timeline-event">
                                    <div class="timeline-header border-bottom mb-3">
                                        <h6 class="mb-0">Narxi</h6>
                                    </div>
                                    <div class="d-flex justify-content-between flex-wrap mb-2">
                                        <div>
                                            <span>{{ $book->price }} soʻm</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item timeline-item-danger mb-4">
                                <span class="timeline-indicator timeline-indicator-danger">
                                    <i class="bx bx-menu-alt-right"></i>
                                </span>
                                <div class="timeline-event">
                                    <div class="timeline-header border-bottom mb-3">
                                        <h6 class="mb-0">Ishlab chiqaruvchi</h6>
                                    </div>
                                    <div class="d-flex justify-content-between flex-wrap mb-2">
                                        <div>
                                            <span>{{ $book->publisher }}</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item timeline-item-primary mb-4">
                                <span class="timeline-indicator timeline-indicator-primary">
                                    <i class="bx bx-menu-alt-right"></i>
                                </span>
                                <div class="timeline-event">
                                    <div class="timeline-header border-bottom mb-3">
                                        <h6 class="mb-0">Ishlab chiqarilgan shahar</h6>
                                    </div>
                                    <div class="d-flex justify-content-between flex-wrap mb-2">
                                        <div>
                                            <span>{{ $book->cityPublication }}</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item timeline-item-info mb-4">
                                <span class="timeline-indicator timeline-indicator-info">
                                    <i class="bx bx-menu-alt-right"></i>
                                </span>
                                <div class="timeline-event">
                                    <div class="timeline-header border-bottom mb-3">
                                        <h6 class="mb-0">Qayerdan kelgan</h6>
                                    </div>
                                    <div class="d-flex justify-content-between flex-wrap mb-2">
                                        <div>
                                            <span>
                                                @if ($book->comeFrom == 1)
                                                    MDX davlatlari
                                                @elseif ($book->comeFrom == 2)
                                                    Horijiyn mamlakat
                                                @else
                                                    Boshqa
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item timeline-item-success mb-4">
                                <span class="timeline-indicator timeline-indicator-success">
                                    <i class="bx bx-menu-alt-right"></i>
                                </span>
                                <div class="timeline-event">
                                    <div class="timeline-header border-bottom mb-3">
                                        <h6 class="mb-0">Kimlar uchun moʻljallangan</h6>
                                    </div>
                                    <div class="d-flex justify-content-between flex-wrap mb-2">
                                        <div>
                                            <span>
                                                @if ($book->forWhom == 1)
                                                    Magistr
                                                @elseif ($book->forWhom == 2)
                                                    Bakalavr
                                                @elseif ($book->forWhom == 3)
                                                    Oʻquvchi
                                                @else
                                                    Boshqa
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-end-indicator">
                                <i class="bx bx-check-circle"></i>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
