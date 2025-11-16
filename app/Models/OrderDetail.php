<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_details';
    public $timestamps = true; // migration có timestamps

    protected $fillable = [
        'order_id',
        'MASP',
        'SL',
        'GIAGOC',
        'GIABAN'
    ];

    // Quan hệ với Order
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    // Quan hệ với Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'MASP', 'MASP');
    }
}
