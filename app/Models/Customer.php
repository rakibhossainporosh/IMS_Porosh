<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'email', 'phone', 'address', 'status'])]

class Customer extends Model
{
    protected $casts = [
        'status' => 'boolean'
    ];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
