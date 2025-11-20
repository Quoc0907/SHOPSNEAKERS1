<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseToWarehouse extends Model
{
    use HasFactory;

    protected $table = 'warehouse_to_warehouses';

    protected $fillable = [
        'NGUON_GIAO',
        'DIEM_NHAN',
        'MASP',
        'SL',
        'NGIAO',
        'NNHAN',
        'XOA'
    ];

    public $timestamps = false; // Vì bảng này chỉ dùng NGIAO/NNHAN, không cần created_at/updated_at

    // Kho nguồn
    public function sourceWarehouse()
    {
        return $this->belongsTo(Warehouse::class, 'NGUON_GIAO', 'MAKHO');
    }

    // Kho nhận
    public function targetWarehouse()
    {
        return $this->belongsTo(Warehouse::class, 'DIEM_NHAN', 'MAKHO');
    }

    // Sản phẩm
    public function product()
    {
        return $this->belongsTo(Product::class, 'MASP', 'MASP');
    }
}
