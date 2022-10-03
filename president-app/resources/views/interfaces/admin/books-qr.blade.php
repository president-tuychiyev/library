@extends('layouts.root')

@section('title', 'QR kodlar')

@section('search')
    <form action="{{ route('admin.books.search') }}" method="get">
        <input type="text" class="form-control border-0 shadow-none" name="q" placeholder="Kitob qidirish..."
            aria-label="Kitob qidirish...">
    </form>
@stop

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="demo-inline-spacing">
                            <button type="button" class="btn btn-icon btn-outline-primary" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-original-title="QR kodlarni printerga yuborish" onclick="printDocument()">
                                <span class="tf-icons bx bx-printer"></span>
                            </button>
                        </div>
                    </div>
                    <div class="card-body text-center flex overflow-x-auto" id="printDiv">
                        @foreach ($books as $b)
                            <div class="px-2" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip"
                                data-bs-placement="top" title="{{ Str::substr($b->name, 0, 20) }}...">
                                <a href="#">{!! DNS2D::getBarcodeSVG((string) $b->id, 'QRCODE') !!}</a>
                                <small>{{ $b->created_at->format('d.m.Y') }}</small>
                            </div>
                        @endforeach
                    </div>
                    <div class="card-footer">
                        {{ $books->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
