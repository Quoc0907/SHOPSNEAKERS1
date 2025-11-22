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
                            <h4 class="card-title pull-left">Tồn kho</h4>
                            <a href="{{ route('admin.warehouse.stock.create') }}"
                                 class="btn btn-outline-primary pull-right">
                                 Thêm mới
                             </a>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="text-primary">
                                        <tr>
                                            <th>#</th>
                                            <th>Mã kho</th>
                                            <th>Mã sản phẩm</th>
                                            <th>Số lượng</th>
                                            <th class="text-right">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($stocks as $stock)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $stock->warehouse->TENKHO ?? $stock->MAKHO }}</td>
                                            <td>{{ $stock->product->TENSP ?? $stock->MASP }}</td>
                                            <td>{{ $stock->SL }}</td>
                                            <td class="text-right">
                                                <a href="{{ route('admin.warehouse.stock.edit', ['MAKHO' => $stock->MAKHO, 'MASP' => $stock->MASP]) }}"
                                                   class="btn btn-warning">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                @if($stocks->isEmpty())
                                    <p class="text-center mt-3">Chưa có sản phẩm nào trong kho.</p>
                                @endif
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
