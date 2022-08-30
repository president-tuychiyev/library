@extends('layouts.root')

@section('title', 'QR kodlar')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center flex">
                        @foreach ($books as $b)
                            <div class="px-2" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $b->name }}">
                                <a href="#">{!! DNS2D::getBarcodeSVG((string) $b->id, 'QRCODE') !!}</a>
                                <small>{{ $b->created_at->format('d.m.Y') }}</small>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
