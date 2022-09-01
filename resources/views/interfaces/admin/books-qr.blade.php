@extends('layouts.root')

@section('title', 'QR kodlar')

@section('content')
    @php($name = 'name' . app()->getLocale())
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center flex">
                        @foreach ($books as $b)
                            <div class="px-2" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip"
                                data-bs-placement="top" title="{{ Str::substr($b->$name, 0, 20) }}...">
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
