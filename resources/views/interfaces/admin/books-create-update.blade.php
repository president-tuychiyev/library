@extends('layouts.root')

@section('title', "Kitob qo'shish - yangilash")

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <form
            action="@isset($book) {{ route('admin.books.update') }} @else {{ route('admin.books.insert') }} @endisset"
            method="post" enctype="multipart/form-data" class="row">
            @csrf
            @isset($book)
                <input type="text" name="id" value="{{ $book->id }}" hidden required>
            @endisset
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="doc-type">Kitob
                                muallifi</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span id="doc-type" class="input-group-text"><i class="bx bx-file"></i></span>
                                    <select class="form-select" id="doc-type" name="authorId" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="majburiy bo'lim" required>
                                        @foreach ($authors as $a)
                                            <option @if (isset($book) && $a->id == $book->authorId) selected="true" @endif
                                                value="{{ $a->id }}">{{ $a->name }}</option>
                                        @endforeach
                                        <option value="0">Boshqa</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="publish-book">Nashriyot</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-label"></i></span>
                                    <input type="text" name="cityPublication" id="publish-book"
                                        value="@isset($book){{ $book->cityPublication }}@else{{ old('cityPublication') }}@endisset"
                                        class="form-control" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="majburiy emas">
                                </div>
                                <div class="form-text">kitob nashr qilinga shaharni kiriting</div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="publisher-book">Nashriyot</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-label"></i></span>
                                    <input type="text" name="publisher"
                                        value="@isset($book){{ $book->publisher }}@else{{ old('publisher') }}@endisset"
                                        id="publisher-book" class="form-control" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="majburiy emas">
                                </div>
                                <div class="form-text">kitob nashriyot nomini kiriting</div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="date-publish-book">Nashriyot</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                                    <input class="form-control" type="date" name="datePublication"
                                        value="@isset($book){{ date('Y-m-d', strtotime($book->datePublication)) }}@else{{ old('datePublication') }}@endisset"
                                        id="date-publish-book" required data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="majburiy bo'lim">
                                </div>
                                <div class="form-text">kitob nashr qilingan sanani kiriting</div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="page-count-book">Betlar soni</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-calculator"></i></span>
                                    <input type="number" name="numPage"
                                        value="@isset($book){{ $book->numPage }}@else{{ old('numPage') }}@endisset"
                                        id="page-count-book" class="form-control" required data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="majburiy bo'lim">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="page-count-book">Narxi</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-wallet-alt"></i></span>
                                    <input type="number" name="price"
                                        value="@isset($book){{ $book->price }}@else{{ old('price') }}@endisset"
                                        id="page-count-book" class="form-control" required data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="majburiy bo'lim">
                                    <span class="input-group-text" id="basic-addon2">so'm</span>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="udk-book">UDK</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-label"></i></span>
                                    <input type="text" name="udk"
                                        value="@isset($book){{ $book->udk }}@else{{ old('udk') }}@endisset"
                                        id="udk-book" class="form-control" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="majburiy emas">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="isbn-book">ISBN</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-label"></i></span>
                                    <input type="text" name="isbn"
                                        value="@isset($book){{ $book->isbn }}@else{{ old('isbn') }}@endisset"
                                        id="isbn-book" class="form-control" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="majburiy emas">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Kitob
                                turi</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span id="select-document-type" class="input-group-text"><i
                                            class="bx bx-file"></i></span>
                                    <select class="form-select" name="docTypeId" id="select-document-type" required
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="majburiy bo'lim">
                                        @foreach ($details->where('type', 1) as $d)
                                            <option @if (isset($book) && $a->id == $book->docTypeId) selected="true" @endif
                                                value="{{ $d->id }}">{{ $d->name }}</option>
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
                                    <select class="form-select" name="docLangId" id="select-document-type" required
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="majburiy bo'lim">
                                        @foreach ($details->where('type', 2) as $d)
                                            <option @if (isset($book) && $a->id == $book->docLangId) selected="true" @endif
                                                value="{{ $d->id }}">{{ $d->name }}</option>
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
                                    <select class="form-select" name="textTypeId" id="select-document-type" required
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="majburiy bo'lim">
                                        @foreach ($details->where('type', 3) as $d)
                                            <option @if (isset($book) && $a->id == $book->textTypeId) selected="true" @endif
                                                value="{{ $d->id }}">{{ $d->name }}</option>
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
                                    <select class="form-select" name="docFormatId" id="select-document-type" required
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="majburiy bo'lim">
                                        @foreach ($details->where('type', 4) as $d)
                                            <option @if (isset($book) && $a->id == $book->docFormatId) selected="true" @endif
                                                value="{{ $d->id }}">{{ $d->name }}</option>
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
                                    <select class="form-select" name="fileTypeId" id="select-document-type" required
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="majburiy bo'lim">
                                        @foreach ($details->where('type', 5) as $d)
                                            <option @if (isset($book) && $a->id == $book->fileTypeId) selected="true" @endif
                                                value="{{ $d->id }}">{{ $d->name }}</option>
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
                                    <select class="form-select" name="directId" id="select-document-type" required
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="majburiy bo'lim">
                                        @foreach ($details->where('type', 5) as $d)
                                            <option @if (isset($book) && $a->id == $book->directId) selected="true" @endif
                                                value="{{ $d->id }}">{{ $d->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="come-from-book">Qayerdan kelgan</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span id="come-from-book" class="input-group-text"><i class="bx bx-globe"></i></span>
                                    <select class="form-select" name="comeFrom" id="come-from-book" required
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="majburiy bo'lim">
                                        <option @if (isset($book) && 1 == $book->comeFrom) selected="true" @endif value="1">
                                            MDX davlatidan</option>
                                        <option @if (isset($book) && 2 == $book->comeFrom) selected="true" @endif value="2">
                                            Horij mamlakatidan</option>
                                        <option @if (isset($book) && 3 == $book->comeFrom) selected="true" @endif value="3">
                                            Boshqa</option>
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
                                    <select class="form-select" name="forWhom" id="come-from-book" required
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="majburiy bo'lim">
                                        <option @if (isset($book) && 1 == $book->forWhom) selected="true" @endif value="1">
                                            Magistr</option>
                                        <option @if (isset($book) && 2 == $book->forWhom) selected="true" @endif value="2">
                                            Bakalavr</option>
                                        <option @if (isset($book) && 3 == $book->forWhom) selected="true" @endif value="3">
                                            O'quvchi</option>
                                        <option @if (isset($book) && 4 == $book->forWhom) selected="true" @endif value="4">
                                            Boshqa</option>
                                    </select>
                                </div>
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
                                        <textarea name="nameuz" id="title-book" rows="3" class="form-control" required data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="majburiy bo'lim">
@isset($book)
{{ $book->nameuz }}@else{{ old('nameuz') }}
@endisset
</textarea>
                                    </div>
                                    <div class="form-text">kitob nomini kiriting</div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 form-label" for="annontatsion-book">Annotatsiya</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-message2" class="input-group-text"><i
                                                class="bx bx-label"></i></span>
                                        <textarea id="annontatsion-book" name="annouz" rows="5" class="form-control" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="majburiy emas">
@isset($book)
{{ $book->annouz }}@else{{ old('annouz') }}
@endisset
</textarea>
                                    </div>
                                    <div class="form-text">qisqacha annontatsiya kiriting</div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="details-ru" role="tabpanel">
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="title-book">Название книги</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-label"></i></span>
                                        <textarea name="nameru" rows="3" id="title-book" class="form-control" required data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="обязательный раздел">
@isset($book)
{{ $book->nameru }}@else{{ old('nameru') }}
@endisset
</textarea>
                                    </div>
                                    <div class="form-text">введите название книги</div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 form-label" for="annontatsion-book">Абстрактный</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-message2" class="input-group-text"><i
                                                class="bx bx-label"></i></span>
                                        <textarea id="annontatsion-book" name="annoru" rows="5" class="form-control" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="не обязательно">
@isset($book)
{{ $book->annoru }}@else{{ old('annoru') }}
@endisset
</textarea>
                                    </div>
                                    <div class="form-text">введите краткую аннотацию</div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="details-en" role="tabpanel">
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="title-book">Name of the book</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-label"></i></span>
                                        <textarea name="nameen" id="title-book" rows="3" class="form-control" required data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="mandatory section">
@isset($book)
{{ $book->nameen }}@else{{ old('nameen') }}
@endisset
</textarea>
                                    </div>
                                    <div class="form-text">enter the title of the book</div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 form-label" for="annontatsion-book">Abstract</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-message2" class="input-group-text"><i
                                                class="bx bx-label"></i></span>
                                        <textarea id="annontatsion-book" name="annoen" rows="5" class="form-control" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="not mandatory">
@isset($book)
{{ $book->annoen }}@else{{ old('annoen') }}
@endisset
</textarea>
                                    </div>
                                    <div class="form-text">enter a brief annotation</div>
                                </div>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label class="col-sm-2 form-label" for="cover-media-book">Muqova tasviri</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <input class="form-control" name="coverMedia" type="file" id="cover-media-book"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="majburiy emas"
                                        accept=".jpg,.jpeg,.png">
                                    <span class="input-group-text text-red-300" id="doc-media-book">*jpg, *png</span>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 form-label" for="doc-media-book">To‘liq matn fayli</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <input class="form-control" name="docMedia" type="file" id="doc-media-book"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="majburiy emas"
                                        accept=".pdf,.doc,.docx">
                                    <span class="input-group-text text-red-300" id="doc-media-book">*pdf, *word</span>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 form-label" for="is-active-book">Aktivligi</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <select class="form-select" name="isActive" id="is-active-book"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="majburiy emas">
                                        <option @if (isset($book) && 1 == $book->isActive) selected="true" @endif value="1">
                                            Faol</option>
                                        <option @if (isset($book) && 0 == $book->isActive) selected="true" @endif value="0">
                                            Faol emas</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary bg-indigo-500">
                                    @isset($book)
                                        Yangilash
                                    @else
                                        Qo'shish
                                    @endisset
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop
