<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    protected $table = 'customers';

    protected $primaryKey = 'id';

    protected $fillable = [
        'NAME',
        'EMAIL',
        'PASSWORD',
        'PHONE',
        'ADDRESS',
    ];

    protected $hidden = [
        'PASSWORD',
    ];

    public function getAuthPassword()
    {
        return $this->PASSWORD;
    }
}
