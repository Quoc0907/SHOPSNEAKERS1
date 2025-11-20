<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WarehouseDetail extends Model
{
    protected $table = 'warehouse_details';
    protected $primaryKey = ['MAKHO', 'MASP'];
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['MAKHO','MASP','SL'];

    public function warehouse() {
        return $this->belongsTo(Warehouse::class, 'MAKHO', 'MAKHO');
    }

    public function product() {
        return $this->belongsTo(Product::class, 'MASP', 'MASP');
    }
}

