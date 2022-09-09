@extends('layouts.root')

@section('title', 'Kitb olish & berish')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-6 col-lg-4 col-xl-6 order-0 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Kitob olganlar</h5>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 col-xl-6 order-0 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Kitobni vaqtida qaytarmaganlar</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
