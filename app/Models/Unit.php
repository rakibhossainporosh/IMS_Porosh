<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'short_code'])]

class Unit extends Model
{
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
