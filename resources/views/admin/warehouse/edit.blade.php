@extends("layout.admin")
@section("main")
<div class="wrapper">
    @include("admin.sidebar")
    <div class="main-panel">
        @include("admin.navbar")

        <div class="content">
            <h3>{{ $data ? 'Sửa kho: '.$data->TENKHO : 'Thêm kho mới' }}</h3>

            <form method="POST" 
                action="{{ $data 
                    ? route('admin.warehouse.update', $data->MAKHO) 
                    : route('admin.warehouse.store') }}">
                @csrf
                @if($data)
                    @method('PUT')
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-3">
                    <label class="form-label">Mã kho</label>
                    <input type="text" name="MAKHO" class="form-control" 
                           value="{{ $data->MAKHO ?? old('MAKHO') }}" 
                           {{ $data ? 'readonly' : '' }} required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tên kho</label>
                    <input type="text" name="TENKHO" class="form-control" 
                           value="{{ $data->TENKHO ?? old('TENKHO') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Địa chỉ</label>
                    <input type="text" name="DCHI" class="form-control" 
                           value="{{ $data->DCHI ?? old('DCHI') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Số điện thoại</label>
                    <input type="text" name="SODT" class="form-control" 
                           value="{{ $data->SODT ?? old('SODT') }}">
                </div>

                <button type="submit" class="btn btn-primary mt-3">Lưu</button>
            </form>
        </div>

        @include("admin.footer")
    </div>
</div>
@stop
