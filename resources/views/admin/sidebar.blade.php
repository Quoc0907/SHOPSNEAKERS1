<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
        <a href="https://www.creative-tim.com" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="{{ asset("public/backend") }}/img/logo-small.png">
            </div>
            <!-- <p>CT</p> -->
        </a>
        <a href="https://www.creative-tim.com" class="simple-text logo-normal">
            Creative Tim
        <!-- <div class="logo-image-big">
                  <img src="{{ asset("public/backend") }}/img/logo-big.png">
                </div> -->
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            @php
                $route = Route::currentRouteAction(); // lay thong tin route hien tai
                $route_data = explode("@", $route);
                $controllerName = class_basename($route_data[0]); // ten controller
                $actionName = $route_data[1]; // ten action
                // echo "Current controller: {$controllerName} <br>";
                //echo "Current action: {$actionName}";
            @endphp
            <li @if($controllerName == "HomeController") class="active " @endif>
                <a href="{{ route('admin.home.index') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>Trang chủ</p>
                </a>
            </li>
            <li @if($controllerName == "CategoryController") class="active " @endif>
                <a href="{{ route("admin.category.index") }}">
                    <i class="nc-icon nc-diamond"></i>
                    <p>Quản lý danh mục</p>
                </a>
            </li>
            <li @if($controllerName == "ProductController") class="active " @endif>
                <a href="{{ route('admin.product.index') }}">
                    <i class="nc-icon nc-pin-3"></i>
                    <p>Quản lý sản phẩm</p>
                </a>
            </li>
            <li @if($controllerName == "OrderController") class="active " @endif>
                <a href="{{ route('admin.order.index') }}">
                    <i class="nc-icon nc-bell-55"></i>
                    <p>Quản lý đơn hàng</p>
                </a>
            </li>
            <li @if($controllerName == "WarehouseController" and $actionName == "index") class="active " @endif>
                <a href="{{ route('admin.warehouse.index') }}">
                    <i class="nc-icon nc-single-02"></i>
                    <p>Quản lý kho hàng</p>
                </a>
            </li>
            <li @if($controllerName == "WarehouseController" and $actionName == "stock") class="active " @endif>
                <a href="{{ route('admin.warehouse.stock') }}">
                    <i class="nc-icon nc-tile-56"></i>
                    <p>Quản lý tồn kho</p>
                </a>
            </li>
            <li @if($controllerName == "WarehouseController" and $actionName == "transfer") class="active " @endif>
                <a href="{{ route('admin.warehouse.transfer') }}">
                    <i class="nc-icon nc-tile-56"></i>
                    <p>Quản lý chuyển hàng</p>
                </a>
            </li>
        </ul>
    </div>
</div>
