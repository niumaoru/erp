<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_number', 'product_name', 'short_name', 'category', 'brand_id',
        'specification', 'country', 'unit', 'weight', 'volume', 'record_code',
        'barcode', 'hs_code', 'note'
    ];

    protected $casts = ['enable' => 'boolean'];

    public function brand(){
        return $this->belongsTo(Brand::class);
    }
}
