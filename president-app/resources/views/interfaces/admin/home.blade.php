@extends('layouts.root')

@section('title', 'Bosh sahifa')

@section('search')
    <form action="{{ route('admin.books.search') }}" method="get">
        <input type="text" class="form-control border-0 shadow-none" name="q" placeholder="Kitob qidirish..."
            aria-label="Kitob qidirish...">
    </form>
@stop

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-8 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Siz tomoningizda kiritilgan jami ma'lumotlar  <span class="fw-bold">10%</span> dan ortdi 🎉</h5>
                                <p class="mb-4">Ushbu ma'lumot, elektron kutbhona tizimining umumiy ma'lumotlariga asoslanib dinamik hisoblashni amalga oshiradi.</p>
                                <a href="{{ route('admin.books') }}" class="btn btn-sm btn-label-primary">Kitoblar</a>
                                <a href="{{ route('admin.journals') }}" class="btn btn-sm btn-label-warning">Jurnallar</a>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="{{ asset('img/man-with-laptop-light.png') }}" height="140">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
