<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon; // cần import Carbon

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders'; 
    protected $primaryKey = 'id'; // hoặc 'SOHD' nếu bạn dùng khác
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

    // Cast kiểu ngày
    protected $casts = [
        'NGHD' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Accessor để format ngày
    public function getFormattedNGHDAttribute()
    {
        // ép kiểu Carbon nếu NGHD chưa phải object
        return $this->NGHD instanceof Carbon ? $this->NGHD->format('d-m-Y') : Carbon::parse($this->NGHD)->format('d-m-Y');
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
