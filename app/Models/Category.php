<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    // Mối quan hệ: Một Category có nhiều Product
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
