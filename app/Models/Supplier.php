<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'email', 'phone', 'address', 'status'])]

class Supplier extends Model
{
    protected $casts = [
        'status' => 'boolean'
    ];
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
