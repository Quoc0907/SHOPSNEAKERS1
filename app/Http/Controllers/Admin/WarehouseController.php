<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warehouse;
use App\Models\WarehouseDetail;
use App\Models\Product;
use App\Models\WarehouseToWarehouse;

class WarehouseController extends Controller
{
    // -----------------------------
    // Danh sách kho
    // -----------------------------
    public function index(){
        $warehouses = Warehouse::all();
        return view("admin.warehouse.index", compact('warehouses'));
    }

    // Thêm/Sửa kho
    public function edit($warehouse = null){
        $data = $warehouse ? Warehouse::find($warehouse) : null;
        return view("admin.warehouse.edit", compact("data"));
    }

    public function update(Request $request){
        $request->validate([
            'MAKHO'=>'required|max:20',
            'TENKHO'=>'required|max:40',
            'DCHI'=>'required|max:50',
            'SODT'=>'required|max:20'
        ]);

        Warehouse::updateOrCreate(
            ['MAKHO'=>$request->MAKHO],
            $request->only('TENKHO','DCHI','SODT')
        );

        return redirect()->route('admin.warehouse.index')->with('success','Cập nhật kho thành công!');
    }

    // Xóa kho
    public function delete($warehouse){
        Warehouse::find($warehouse)?->delete();
        return redirect()->route('admin.warehouse.index')->with('success','Xóa kho thành công!');
    }

    // -----------------------------
    // Quản lý tồn kho sản phẩm
    // -----------------------------
    public function stock(){
        $stocks = WarehouseDetail::with('warehouse','product')->get();
        return view('admin.warehouse.stock', compact('stocks'));
    }

    public function edit_stock($MAKHO = null, $MASP = null){
        $data = $MAKHO && $MASP ? WarehouseDetail::find([$MAKHO,$MASP]) : null;
        $warehouses = Warehouse::all();
        $products = Product::all();
        return view('admin.warehouse.edit_stock', compact('data','warehouses','products'));
    }

    public function update_stock(Request $request){
        $request->validate([
            'MAKHO'=>'required',
            'MASP'=>'required',
            'SL'=>'required|integer|min:0'
        ]);

        WarehouseDetail::updateOrCreate(
            ['MAKHO'=>$request->MAKHO,'MASP'=>$request->MASP],
            ['SL'=>$request->SL]
        );

        return redirect()->route('admin.warehouse.stock')->with('success','Cập nhật tồn kho thành công!');
    }

    // -----------------------------
    // Quản lý chuyển kho
    // -----------------------------
    public function transfer()
    {
        $warehouses = Warehouse::all();
        $transfers = WarehouseToWarehouse::with(['product','sourceWarehouse','targetWarehouse'])
                     ->orderBy('NGIAO','desc')
                     ->get();

        return view('admin.warehouse.transfer', compact('warehouses','transfers'));
    }

    // Form thêm mới chuyển kho
    public function create_transfer()
    {
        $warehouses = Warehouse::all();
        $products = Product::all();
        return view('admin.warehouse.create_transfer', compact('warehouses','products'));
    }

    // Lưu chuyển kho
    public function store_transfer(Request $request)
    {
        $request->validate([
            'NGUON_GIAO'=>'required',
            'DIEM_NHAN'=>'required|different:NGUON_GIAO',
            'MASP'=>'required',
            'SL'=>'required|integer|min:1',
            'NNHAN'=>'required|date'
        ]);

        // Kiểm tra tồn kho kho nguồn
        $source = WarehouseDetail::where('MAKHO',$request->NGUON_GIAO)
                                 ->where('MASP',$request->MASP)
                                 ->first();

        if(!$source || $source->SL < $request->SL){
            return back()->with('error','Số lượng kho nguồn không đủ');
        }

        // Trừ kho nguồn
        $source->SL -= $request->SL;
        $source->save();

        // Cộng kho nhận
        WarehouseDetail::updateOrCreate(
            ['MAKHO'=>$request->DIEM_NHAN,'MASP'=>$request->MASP],
            ['SL'=> \DB::raw("SL + {$request->SL}")]
        );

        // Lưu lịch sử chuyển kho
        WarehouseToWarehouse::create($request->only('NGUON_GIAO','DIEM_NHAN','MASP','SL','NNHAN'));

        return redirect()->route('admin.warehouse.transfer')->with('success','Chuyển kho thành công!');
    }
}
