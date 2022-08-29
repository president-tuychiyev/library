@extends('layouts.root')

@section('title', 'Kitoblar')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
          <div class="card-header d-flex align-items-center justify-content-between pb-0">
            <div class="card-title mb-0">
              <strong class="m-0 me-2">Turi</strong>
          </div>
          <div class="dropdown">
              <a href="{{ route('admin.books.add') }}" class="btn p-0 text-violet-800">
                  <i class="bx bx-message-square-add"></i>
              </a>
          </div>
          </div>  
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>nomi</th>
                            <th>holati</th>
                            <th>yaratuvchi</th>
                            <th>harakatlar</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($books as $b)
                            <tr>
                                <td><strong>{{ $b->id }}</strong></td>
                                <td>{{ $b->name }}</td>
                                <td>
                                    @if ($dt->isActive)
                                        <small class="badge bg-label-primary me-1"> <i class="bx bx-check-shield"></i></small>
                                    @else
                                        <small class="badge bg-label-danger me-1"><i class="bx bx-shield-alt-2"></i></small>
                                    @endif
                                </td>
                                <td>{{ $b->username }}</td>
                                <td>
                                    <a href="javascript:void(0);"><i class="bx bx-show me-1"></i></a>
                                    <a href="javascript:void(0);"><i class="bx bx-edit me-1"></i></a>
                                    <a href="javascript:void(0);"><i class="bx bx-trash me-1"></i></a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>`
@stop
