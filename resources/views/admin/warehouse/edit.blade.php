@extends("layout.admin")
@section("main")
<div class="wrapper">
    @include("admin.sidebar")
    <div class="main-panel">
        @include("admin.navbar")

        <div class="content">
            <h3>{{ $data ? 'Sửa kho: '.$data->TENKHO : 'Thêm kho mới' }}</h3>

            <form method="POST" action="">
                @csrf

                <label>Mã kho</label>
                <input type="text" name="MAKHO" value="{{ $data->MAKHO ?? '' }}" class="form-control">

                <label>Tên kho</label>
                <input type="text" name="TENKHO" value="{{ $data->TENKHO ?? '' }}" class="form-control">

                <label>Địa chỉ</label>
                <input type="text" name="DCHI" value="{{ $data->DCHI ?? '' }}" class="form-control">

                <label>Số điện thoại</label>
                <input type="text" name="SODT" value="{{ $data->SODT ?? '' }}" class="form-control">

                <button class="btn btn-primary mt-3">Lưu</button>
            </form>
        </div>

        @include("admin.footer")
    </div>
</div>
@stop
