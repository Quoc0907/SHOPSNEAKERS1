@extends("layout.admin")
@section("main")
<div class="wrapper">
    @include("admin.sidebar")
    <div class="main-panel">
        @include("admin.navbar")

        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Kho hàng</h4>
                            <a href="{{ route('admin.warehouse.create') }}" class="btn btn-outline-primary">
                                Thêm mới
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead class="text-primary">
                                        <tr>
                                            <th>#</th>
                                            <th>Mã kho</th>
                                            <th>Tên kho</th>
                                            <th>Địa chỉ</th>
                                            <th>Số điện thoại</th>
                                            <th class="text-right">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($warehouses as $kho)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $kho->MAKHO }}</td>
                                                <td>{{ $kho->TENKHO }}</td>
                                                <td>{{ $kho->DCHI }}</td>
                                                <td>{{ $kho->SODT }}</td>
                                                <td class="text-right">
                                                    <a href="{{ route('admin.warehouse.edit', ['warehouse' => $kho->MAKHO]) }}"
                                                       class="btn btn-warning btn-sm">
                                                       <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('admin.warehouse.delete', ['warehouse' => $kho->MAKHO]) }}" 
                                                          method="POST" style="display:inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa kho này?')">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @if($warehouses->isEmpty())
                                            <tr>
                                                <td colspan="6" class="text-center">Chưa có kho nào</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include("admin.footer")
    </div>
</div>
@stop
