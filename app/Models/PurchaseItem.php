<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['purchase_id', 'product_id', 'quantity', 'unit_cost', 'subtotal'])]

class PurchaseItem extends Model
{
    protected $casts = [
        'unit_cost' => 'decimal:2',
        'subtotal' => 'decimal:2'
    ];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
