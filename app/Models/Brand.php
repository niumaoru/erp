<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'brand_number', 'brand_name', 'enable'
    ];

    protected $casts = [
        'enable' => 'boolean'
    ];

    public function products(){
        return $this->hasMany(Product::class);
    }
}
