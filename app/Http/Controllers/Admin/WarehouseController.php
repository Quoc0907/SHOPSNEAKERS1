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
    public function index()
    {
        $warehouses = Warehouse::all();
        return view("admin.warehouse.index", compact('warehouses'));
    }

    // -----------------------------
    // Form thêm kho mới
    // -----------------------------
    public function create()
    {
        $data = null; // để form biết là thêm mới
        return view("admin.warehouse.edit", compact("data"));
    }

    // -----------------------------
    // Form sửa kho
    // -----------------------------
    public function edit($warehouse)
    {
        $data = Warehouse::findOrFail($warehouse);
        return view("admin.warehouse.edit", compact("data"));
    }

    // -----------------------------
    // Lưu kho mới
    // -----------------------------
    public function store(Request $request)
    {
        $request->validate([
            'MAKHO'=>'required|max:20|unique:warehouses,MAKHO',
            'TENKHO'=>'required|max:40',
            'DCHI'=>'required|max:50',
            'SODT'=>'required|max:20'
        ]);

        Warehouse::create($request->only('MAKHO','TENKHO','DCHI','SODT'));

        return redirect()->route('admin.warehouse.index')->with('success','Thêm kho thành công!');
    }

    // -----------------------------
    // Cập nhật kho
    // -----------------------------
    public function update(Request $request, $warehouse)
    {
        $request->validate([
            'TENKHO'=>'required|max:40',
            'DCHI'=>'required|max:50',
            'SODT'=>'required|max:20'
        ]);

        $kho = Warehouse::findOrFail($warehouse);
        $kho->update($request->only('TENKHO','DCHI','SODT'));

        return redirect()->route('admin.warehouse.index')->with('success','Cập nhật kho thành công!');
    }

    // -----------------------------
    // Xóa kho
    // -----------------------------
    public function delete($warehouse)
    {
        Warehouse::findOrFail($warehouse)->delete();
        return redirect()->route('admin.warehouse.index')->with('success','Xóa kho thành công!');
    }

    // -----------------------------
    // Quản lý tồn kho sản phẩm
    // -----------------------------
    public function stock()
    {
        $stocks = WarehouseDetail::with('warehouse','product')->get();
        return view('admin.warehouse.stock', compact('stocks'));
    }

    // Form thêm mới tồn kho
    public function create_stock()
    {
        $data = null;
        $warehouses = Warehouse::all();
        $products = Product::all();
        return view('admin.warehouse.edit_stock', compact('data','warehouses','products'));
    }

    // Form sửa tồn kho
    public function edit_stock($MAKHO, $MASP)
    {
        $data = WarehouseDetail::find([$MAKHO,$MASP]);
        $warehouses = Warehouse::all();
        $products = Product::all();
        return view('admin.warehouse.edit_stock', compact('data','warehouses','products'));
    }

    // Lưu tồn kho (thêm mới hoặc update)
    public function update_stock(Request $request)
    {
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

    public function create_transfer()
    {
        $warehouses = Warehouse::all();
        $products = Product::all();
        return view('admin.warehouse.create_transfer', compact('warehouses','products'));
    }

    public function store_transfer(Request $request)
    {
        $request->validate([
            'NGUON_GIAO'=>'required',
            'DIEM_NHAN'=>'required|different:NGUON_GIAO',
            'MASP'=>'required',
            'SL'=>'required|integer|min:1',
            'NNHAN'=>'required|date'
        ]);

        $source = WarehouseDetail::where('MAKHO',$request->NGUON_GIAO)
                                 ->where('MASP',$request->MASP)
                                 ->first();

        if(!$source || $source->SL < $request->SL){
            return back()->with('error','Số lượng kho nguồn không đủ');
        }

        $source->SL -= $request->SL;
        $source->save();

        WarehouseDetail::updateOrCreate(
            ['MAKHO'=>$request->DIEM_NHAN,'MASP'=>$request->MASP],
            ['SL'=> \DB::raw("SL + {$request->SL}")]
        );

        WarehouseToWarehouse::create($request->only('NGUON_GIAO','DIEM_NHAN','MASP','SL','NNHAN'));

        return redirect()->route('admin.warehouse.transfer')->with('success','Chuyển kho thành công!');
    }
}
