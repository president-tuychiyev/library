@extends('layouts.root')

@section('title', 'Bosh sahifa')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">




            <div class="col-lg-8 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Siz tomoningizda qo'shilgan jami kitoblar va jurnallar 🎉
                                </h5>
                                <p class="mb-4">Elektron kutibhonamizning <span class="fw-bold">72%</span> kitoblari hamda
                                    <span class="fw-bold">32%</span> jurnallari sizning hisobingiz tomonidan yaratilgan.
                                </p>
                                <div class="d-flex me-3 h-10">
                                    <img src="{{ asset('/img/icons/chart.png') }}" alt="User" class="rounded">
                                    <small class="fw-bold p-1 bg-label-danger rounded-md">Ushbu hisob dinamik dastur tomonidan
                                        hisoblanadi.</small>
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="{{ asset('img/man-with-laptop-light.png') }}" height="140"
                                    alt="library kokand university">
                            </div>
                        </div>
                    </div>
                </div>
            </div>








        </div>
    </div>
@stop
