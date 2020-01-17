<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = ['sort', 'shop_number', 'shop_name', 'platform_id', 'enable'];

    public function platform(){
        return $this->belongsTo(Platform::class);
    }
}
