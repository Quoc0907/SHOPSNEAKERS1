@extends('layout.admin')
@section('main')
<div class="wrapper">
    @include('admin.sidebar')
    <div class="main-panel">
        @include('admin.navbar')
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Chuyển hàng</h4>
                            <a href="{{ route('admin.warehouse.transfer.create') }}" class="btn btn-outline-primary">
                                Thêm mới
                            </a>
                        </div>
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            @if(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Kho nguồn</th>
                                            <th>Kho nhận</th>
                                            <th>Sản phẩm</th>
                                            <th>Số lượng</th>
                                            <th>Ngày giao</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($transfers as $t)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $t->sourceWarehouse->TENKHO ?? $t->NGUON_GIAO }}</td>
                                            <td>{{ $t->targetWarehouse->TENKHO ?? $t->DIEM_NHAN }}</td>
                                            <td>{{ $t->product->TENSP ?? $t->MASP }}</td>
                                            <td>{{ $t->SL }}</td>
                                            <td>{{ $t->NGIAO->format('d/m/Y H:i') }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Chưa có dữ liệu chuyển kho</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       @include('admin.footer')
    </div>
</div>
@stop
