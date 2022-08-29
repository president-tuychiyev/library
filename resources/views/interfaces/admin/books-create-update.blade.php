@extends('layouts.root')

@section('title', "Kitob qo'shish - yangilash")

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="doc-type">Kitob
                                muallifi</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span id="doc-type" class="input-group-text"><i
                                            class="bx bx-file"></i></span>
                                    <select class="form-select" id="doc-type" name="docTypeId" required>
                                        @foreach ($details->where('type', 1) as $d)
                                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                                        @endforeach
                                        <option value="0">Boshqa</option>
                                    </select>
                                </div>
                                <div class="form-text">kitob muallifini tanlang <i
                                    class="text-red-500">(majburiy bo'lim)</i></div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="publish-book">Nashr</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-label"></i></span>
                                    <input type="text" name="cityPublication" id="publish-book" class="form-control">
                                </div>
                                <div class="form-text">kitob nashr qilinga shaharni kiriting <i
                                        class="text-yellow-400">(majburiy emas)</i></div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="publication-book">Nashriyot</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-label"></i></span>
                                    <input type="text" name="publisher" id="publication-book" class="form-control">
                                </div>
                                <div class="form-text">kitob nashriyot nomini kiriting <i
                                        class="text-yellow-400">(majburiy emas)</i></div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="date-publish-book">Nashriyot</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                                    <input class="form-control" type="date" value="{{ now()->format('d.m.Y') }}" id="date-publish-book">
                                </div>
                                <div class="form-text">kitob nashr qilingan sanani kiriting <i class="text-red-500">(majburiy bo'lim)</i></div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="page-count-book">Betlar soni</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-calculator"></i></span>
                                    <input type="number" id="page-count-book" class="form-control">
                                </div>
                                <div class="form-text"><i class="text-red-500">(majburiy bo'lim)</i></div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="page-count-book">Narxi</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-wallet-alt"></i></span>
                                    <input type="number" id="page-count-book" class="form-control">
                                </div>
                                <div class="form-text"><i class="text-red-500">(majburiy bo'lim)</i></div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="udk-book">UDK</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-label"></i></span>
                                    <input type="text" name="udk" id="udk-book" class="form-control">
                                </div>
                                <div class="form-text">kitob udk kodini kiriting <i class="text-yellow-400">(majburiy
                                        emas)</i></div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="isbn-book">ISBN</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-label"></i></span>
                                    <input type="text" id="isbn-book" class="form-control">
                                </div>
                                <div class="form-text">kitob isbn kodini kiriting <i class="text-yellow-400">(majburiy
                                        emas)</i></div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Kitob
                                turi</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span id="select-document-type" class="input-group-text"><i
                                            class="bx bx-file"></i></span>
                                    <select class="form-select" id="select-document-type">
                                        @foreach ($details->where('type', 1) as $d)
                                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Kitob
                                tili</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span id="select-document-type" class="input-group-text"><i
                                            class="bx bx-rocket"></i></span>
                                    <select class="form-select" id="select-document-type">
                                        @foreach ($details->where('type', 2) as $d)
                                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Kitob
                                yozuvi</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span id="select-document-type" class="input-group-text"><i
                                            class="bx bx-message-square-edit"></i></span>
                                    <select class="form-select" id="select-document-type">
                                        @foreach ($details->where('type', 3) as $d)
                                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Matn turi</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span id="select-document-type" class="input-group-text"><i
                                            class="bx bx-edit"></i></span>
                                    <select class="form-select" id="select-document-type">
                                        @foreach ($details->where('type', 4) as $d)
                                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Fayl turi</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span id="select-document-type" class="input-group-text"><i
                                            class="bx bx-file-blank"></i></span>
                                    <select class="form-select" id="select-document-type">
                                        @foreach ($details->where('type', 5) as $d)
                                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Fan
                                yo'nalishi</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span id="select-document-type" class="input-group-text"><i
                                            class="bx bx-link-external"></i></span>
                                    <select class="form-select" id="select-document-type">
                                        @foreach ($details->where('type', 5) as $d)
                                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="come-from-book">Qayerdan kelgan</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span id="come-from-book" class="input-group-text"><i
                                            class="bx bx-globe"></i></span>
                                    <select class="form-select" id="come-from-book" required>
                                        <option value="1">MDX davlatidan</option>
                                        <option value="3">Horij mamlakatidan</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="come-from-book">Kimlar uchun</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span id="come-from-book" class="input-group-text"><i
                                            class="bx bx-street-view"></i></span>
                                    <select class="form-select" id="come-from-book" required>
                                        <option value="1">MDX davlatidan</option>
                                        <option value="3">Horij mamlakatidan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary bg-indigo-500">Qo'shish</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="nav-align-top mb-4">
                    <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                data-bs-target="#details-uz" aria-controls="details-uz"
                                aria-selected="false">O'zbekcha</button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                data-bs-target="#details-ru" aria-controls="details-ru"
                                aria-selected="false">Русский</button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                data-bs-target="#details-en" aria-controls="details-en"
                                aria-selected="false">English</button>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="details-uz" role="tabpanel">
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="title-book">Kitob nomi</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-label"></i></span>
                                        <textarea name="nameuz" id="title-book" rows="3" class="form-control" required></textarea>
                                    </div>
                                    <div class="form-text">kitob nomini kiriting <i class="text-red-400">(majburiy
                                            bo'lim)</i></div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 form-label" for="annontatsion-book">Annotatsiya</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-message2" class="input-group-text"><i
                                                class="bx bx-label"></i></span>
                                        <textarea id="annontatsion-book" name="annouz" rows="5" class="form-control"></textarea>
                                    </div>
                                    <div class="form-text">qisqacha annontatsiya kiriting <i class="text-yellow-400">(majburiy
                                        emas)</i></div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="details-ru" role="tabpanel">
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="title-book">Название книги</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-label"></i></span>
                                        <textarea name="nameru" rows="3" id="title-book" class="form-control" required></textarea>
                                    </div>
                                    <div class="form-text">введите название книги <i class="text-red-400">(обязательный раздел)</i></div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 form-label" for="annontatsion-book">Абстрактный</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-message2" class="input-group-text"><i
                                                class="bx bx-label"></i></span>
                                        <textarea id="annontatsion-book" name="annouz" rows="5" class="form-control"></textarea>
                                    </div>
                                    <div class="form-text">введите краткую аннотацию <i class="text-yellow-400">(не обязательно)</i></div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="details-en" role="tabpanel">
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="title-book">Name of the book</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-label"></i></span>
                                        <textarea name="nameen" id="title-book" rows="3" class="form-control" required></textarea>
                                    </div>
                                    <div class="form-text">enter the title of the book <i class="text-red-400">(mandatory section)</i></div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 form-label" for="annontatsion-book">Abstract</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-message2" class="input-group-text"><i
                                                class="bx bx-label"></i></span>
                                        <textarea id="annontatsion-book" name="annoen" rows="5" class="form-control"></textarea>
                                    </div>
                                    <div class="form-text">enter a brief annotation <i class="text-yellow-400">(not mandatory)</i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
