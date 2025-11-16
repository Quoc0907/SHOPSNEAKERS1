<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders'; 
    protected $primaryKey = 'id'; // hoặc SOHD nếu bạn dùng tên khác
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'MANV',
        'TRIGIA',
        'PTVC',
        'NGHD',
        'TRANGTHAI',
        'token',
    ];

    protected $dates = ['NGHD', 'created_at', 'updated_at'];

    // Accessor để format ngày
    public function getFormattedNGHDAttribute()
    {
        return $this->NGHD->format('d-m-Y');
    }

    // Quan hệ với user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Quan hệ với chi tiết đơn hàng
    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
}
