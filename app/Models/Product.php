<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'slug', 'sku', 'category_id', 'unit_id', 'cost_price', 'selling_price', 'image', 'description', 'status'])]

class Product extends Model
{
    protected $casts = [
        'status' => 'boolean',
        'cost_price' => 'decimal:2',
        'selling_price' => 'decimal:2'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }
    public function purchasesItems()
    {
        return $this->hasMany(PurchaseItem::class);
    }
    public function salesItems()
    {
        return $this->hasMany(SaleItem::class);
    }
    public function stockAdjustments()
    {
        return $this->hasMany(StockAdjustment::class);
    }
    public function totalStock()
    {
        return $this->stocks()->sum('quantity');
    }
}
