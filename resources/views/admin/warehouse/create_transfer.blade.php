@extends('layout.admin')
@section('main')
<div class="wrapper">
    @include('admin.sidebar')
    <div class="main-panel">
        @include('admin.navbar')
        <div class="content">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Thêm mới chuyển kho</h4>
                        </div>
                        <div class="card-body">
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $err)
                                            <li>{{ $err }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('admin.warehouse.transfer.store') }}" method="POST">

                                @csrf
                                <div class="form-group">
                                    <label>Kho nguồn</label>
                                    <select name="NGUON_GIAO" class="form-control" required>
                                        <option value="">-- Chọn kho nguồn --</option>
                                        @foreach($warehouses as $w)
                                            <option value="{{ $w->MAKHO }}">{{ $w->TENKHO }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Kho nhận</label>
                                    <select name="DIEM_NHAN" class="form-control" required>
                                        <option value="">-- Chọn kho nhận --</option>
                                        @foreach($warehouses as $w)
                                            <option value="{{ $w->MAKHO }}">{{ $w->TENKHO }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Sản phẩm</label>
                                    <select name="MASP" class="form-control" required>
                                        <option value="">-- Chọn sản phẩm --</option>
                                        @foreach($products as $p)
                                            <option value="{{ $p->MASP }}">{{ $p->TENSP }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Số lượng</label>
                                    <input type="number" name="SL" class="form-control" min="1" required>
                                </div>
                                <div class="form-group">
                                    <label>Ngày nhận</label>
                                    <input type="date" name="NNHAN" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Lưu</button>
                                <a href="{{ route('admin.warehouse.transfer') }}" class="btn btn-secondary">Hủy</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       @include('admin.footer')
    </div>
</div>
@stop
