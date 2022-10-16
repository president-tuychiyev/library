@extends('layouts.root')

@section('title', "Kitob qo'shish - yangilash")

@section('search')
    <form action="{{ route('admin.books.search') }}" method="get">
        <input type="text" class="form-control border-0 shadow-none" name="q" placeholder="Kitob qidirish..."
            aria-label="Kitob qidirish...">
    </form>
@stop

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
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="doc-type">Kitob nomi</label>
                            <div class="input-group input-group-merge">
                                <input name="name" id="title-book"
                                    value="@isset($book){{ $book->name }}@else{{ old('name') }}@endisset"
                                    class="form-control" required data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="majburiy boʻlim">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="annontation-type">Anotatsiya</label>
                            <div class="input-group input-group-merge">
                                <textarea name="annontation" id="annontation-book" rows="3" class="form-control" required data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="majburiy boʻlim">
@isset($book)
{{ $book->annontation }}@else{{ old('annontation') }}
@endisset
</textarea>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="doc-type">Kitob muallifi</label>
                            <div class="input-group input-group-merge">
                                <span id="doc-type" class="input-group-text"><i class="bx bx-file"></i></span>
                                <select class="form-select" id="doc-type" name="authorId" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="majburiy boʻlim" required>
                                    @foreach ($authors as $a)
                                        <option @if (isset($book) && $a->id == $book->authorId) selected="true" @endif
                                            value="{{ $a->id }}">{{ $a->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="publish-book">Nashriyot</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-label"></i></span>
                                <input type="text" name="cityPublication" id="publish-book"
                                    value="@isset($book){{ $book->cityPublication }}@else{{ old('cityPublication') }}@endisset"
                                    class="form-control" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="majburiy emas">
                            </div>
                            <div class="form-text">kitob nashr qilinga shaharni kiriting</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="publisher-book">Nashriyot</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-label"></i></span>
                                <input type="text" name="publisher"
                                    value="@isset($book){{ $book->publisher }}@else{{ old('publisher') }}@endisset"
                                    id="publisher-book" class="form-control" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="majburiy emas">
                            </div>
                            <div class="form-text">kitob nashriyot nomini kiriting</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="date-publish-book">Nashriyot</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                                <input class="form-control dob-picker flatpickr-input active" type="date"
                                    name="datePublication"
                                    value="@isset($book){{ date('Y-m-d', strtotime($book->datePublication)) }}@else{{ old('datePublication') }}@endisset"
                                    id="date-publish-book" required data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="majburiy boʻlim">
                            </div>
                            <div class="form-text">kitob nashr qilingan sanani kiriting</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="page-count-book">Betlar soni</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-calculator"></i></span>
                                <input type="number" name="numPage"
                                    value="@isset($book){{ $book->numPage }}@else{{ old('numPage') }}@endisset"
                                    id="page-count-book" class="form-control" required data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="majburiy boʻlim">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="page-count-book">Narxi</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-wallet-alt"></i></span>
                                <input type="number" name="price"
                                    value="@isset($book){{ $book->price }}@else{{ old('price') }}@endisset"
                                    id="page-count-book" class="form-control" required data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="majburiy boʻlim">
                                <span class="input-group-text" id="basic-addon2">so'm</span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="udk-book">UDK</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-label"></i></span>
                                <input type="text" name="udk"
                                    value="@isset($book){{ $book->udk }}@else{{ old('udk') }}@endisset"
                                    id="udk-book" class="form-control" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="majburiy emas">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="isbn-book">ISBN</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-label"></i></span>
                                <input type="text" name="isbn"
                                    value="@isset($book){{ $book->isbn }}@else{{ old('isbn') }}@endisset"
                                    id="isbn-book" class="form-control" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="majburiy emas">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Kitob
                                turi</label>
                            <div class="input-group input-group-merge">
                                <span id="select-document-type" class="input-group-text"><i
                                        class="bx bx-file"></i></span>
                                <select class="form-select" name="docTypeId" id="select-document-type" required
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="majburiy boʻlim">
                                    @foreach ($details->where('type', 1) as $d)
                                        <option @if (isset($book) && $a->id == $book->docTypeId) selected="true" @endif
                                            value="{{ $d->id }}">{{ $d->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Kitob
                                tili</label>
                            <div class="input-group input-group-merge">
                                <span id="select-document-type" class="input-group-text"><i
                                        class="bx bx-rocket"></i></span>
                                <select class="form-select" name="docLangId" id="select-document-type" required
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="majburiy boʻlim">
                                    @foreach ($details->where('type', 2) as $d)
                                        <option @if (isset($book) && $a->id == $book->docLangId) selected="true" @endif
                                            value="{{ $d->id }}">{{ $d->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Kitob
                                yozuvi</label>
                            <div class="input-group input-group-merge">
                                <span id="select-document-type" class="input-group-text"><i
                                        class="bx bx-message-square-edit"></i></span>
                                <select class="form-select" name="textTypeId" id="select-document-type" required
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="majburiy boʻlim">
                                    @foreach ($details->where('type', 3) as $d)
                                        <option @if (isset($book) && $a->id == $book->textTypeId) selected="true" @endif
                                            value="{{ $d->id }}">{{ $d->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Matn turi</label>
                            <div class="input-group input-group-merge">
                                <span id="select-document-type" class="input-group-text"><i
                                        class="bx bx-edit"></i></span>
                                <select class="form-select" name="docFormatId" id="select-document-type" required
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="majburiy boʻlim">
                                    @foreach ($details->where('type', 4) as $d)
                                        <option @if (isset($book) && $a->id == $book->docFormatId) selected="true" @endif
                                            value="{{ $d->id }}">{{ $d->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Fayl turi</label>
                            <div class="input-group input-group-merge">
                                <span id="select-document-type" class="input-group-text"><i
                                        class="bx bx-file-blank"></i></span>
                                <select class="form-select" name="fileTypeId" id="select-document-type" required
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="majburiy boʻlim">
                                    @foreach ($details->where('type', 5) as $d)
                                        <option @if (isset($book) && $a->id == $book->fileTypeId) selected="true" @endif
                                            value="{{ $d->id }}">{{ $d->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Fan
                                yo'nalishi</label>
                            <div class="input-group input-group-merge">
                                <span id="select-document-type" class="input-group-text"><i
                                        class="bx bx-link-external"></i></span>
                                <select class="form-select" name="directId" id="select-document-type" required
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="majburiy boʻlim">
                                    @foreach ($details->where('type', 6) as $d)
                                        <option @if (isset($book) && $a->id == $book->directId) selected="true" @endif
                                            value="{{ $d->id }}">{{ $d->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="come-from-book">Qayerdan kelgan</label>
                            <div class="input-group input-group-merge">
                                <span id="come-from-book" class="input-group-text"><i class="bx bx-globe"></i></span>
                                <select class="form-select" name="comeFrom" id="come-from-book" required
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="majburiy boʻlim">
                                    <option @if (isset($book) && 1 == $book->comeFrom) selected="true" @endif value="1">
                                        MDX davlatidan</option>
                                    <option @if (isset($book) && 2 == $book->comeFrom) selected="true" @endif value="2">
                                        Horij mamlakatidan</option>
                                    <option @if (isset($book) && 3 == $book->comeFrom) selected="true" @endif value="3">
                                        Boshqa</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="come-from-book">Kimlar uchun</label>
                            <div class="input-group input-group-merge">
                                <span id="come-from-book" class="input-group-text"><i
                                        class="bx bx-street-view"></i></span>
                                <select class="form-select" name="forWhom" id="come-from-book" required
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="majburiy boʻlim">
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

                        <div class="mb-3">
                            <label class="form-label" for="cover-media-book">Muqova tasviri</label>
                            <div class="input-group input-group-merge">
                                <input class="form-control" name="coverMedia" type="file" id="cover-media-book"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="majburiy emas"
                                    accept=".jpg,.jpeg,.png">
                                <span class="input-group-text text-red-300" id="doc-media-book">*jpg, *png</span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="doc-media-book">To‘liq matn fayli</label>
                            <div class="input-group input-group-merge">
                                <input class="form-control" name="docMedia" type="file" id="doc-media-book"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="majburiy emas"
                                    accept=".pdf,.doc,.docx">
                                <span class="input-group-text text-red-300" id="doc-media-book">*pdf, *word</span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="switch">
                                <input type="checkbox" name="isActiveCheck" id="isActive"
                                    @if (isset($book) && 1 == $book->isActive) checked="true" @endif class="switch-input">
                                <span class="switch-toggle-slider">
                                    <span class="switch-on">
                                        <i class="bx bx-check"></i>
                                    </span>
                                    <span class="switch-off">
                                        <i class="bx bx-x"></i>
                                    </span>
                                </span>
                                <span class="switch-label">Aktivmi ?</span>
                            </label>
                        </div>

                        <div class="mb-1">
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
