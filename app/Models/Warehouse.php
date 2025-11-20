<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $table = 'warehouses';
    protected $primaryKey = 'MAKHO';
    public $incrementing = false;  // vì MAKHO là string
    public $timestamps = false;

    protected $fillable = [
        'MAKHO',
        'TENKHO',
        'DCHI',
        'SODT',
        'XOA'
    ];
}
