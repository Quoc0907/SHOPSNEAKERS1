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
                        <div class="card-header">
                            <h4 class="card-title pull-left">Kho hàng</h4>
                            <a href="{{ route('admin.warehouse.edit') }}"
                               class="btn btn-outline-primary pull-right">
                                Thêm mới
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="text-primary">
                                        <th>#</th>
                                        <th>Mã kho</th>
                                        <th>Tên kho</th>
                                        <th>Địa chỉ</th>
                                        <th>Số điện thoại</th>
                                        <th class="text-right"></th>
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
                                                       class="btn btn-warning">
                                                       <i class="fa fa-edit"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
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
