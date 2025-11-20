@extends('layout.admin')
@section('main')
<div class="wrapper">
    @include('admin.sidebar')
    <div class="main-panel">
        @include('admin.navbar')
        <div class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h4 class="mb-0">{{ $data ? 'Sửa tồn kho' : 'Thêm mới tồn kho' }}</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.warehouse.stock.update') }}" method="post">
                                    @csrf
                                    <div class="form-row mb-3">
                                        <div class="col-md-6">
                                            <label for="MAKHO" class="font-weight-bold">Kho</label>
                                            <select name="MAKHO" id="MAKHO" class="form-control" required>
                                                <option value="">-- Chọn kho --</option>
                                                @foreach($warehouses as $kho)
                                                    <option value="{{ $kho->MAKHO }}" {{ $data && $data->MAKHO==$kho->MAKHO ? 'selected' : '' }}>
                                                        {{ $kho->TENKHO }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="MASP" class="font-weight-bold">Sản phẩm</label>
                                            <select name="MASP" id="MASP" class="form-control" required>
                                                <option value="">-- Chọn sản phẩm --</option>
                                                @foreach($products as $p)
                                                    <option value="{{ $p->MASP }}" {{ $data && $data->MASP==$p->MASP ? 'selected' : '' }}>
                                                        {{ $p->TENSP }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="SL" class="font-weight-bold">Số lượng</label>
                                        <input type="number" name="SL" id="SL" class="form-control" value="{{ $data->SL ?? 0 }}" min="0" required>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-success mr-2">
                                            <i class="fa fa-save"></i> Lưu
                                        </button>
                                        <a href="{{ route('admin.warehouse.stock') }}" class="btn btn-secondary">
                                            <i class="fa fa-times"></i> Hủy
                                        </a>
                                    </div>
                                </form>
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
