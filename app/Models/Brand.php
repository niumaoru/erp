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

    public static function getBrands(){
        return self::where('enable',true)->orderBy('sort')->pluck('brand_name', 'id')->toArray();
    }
}
