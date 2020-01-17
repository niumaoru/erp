<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    protected $fillable = ['platform_name', 'platform_number'];

    public function shops(){
        return $this->hasMany(Shop::class);
    }

    public static function getPlatforms(){
        return self::pluck('platform_name', 'id')->toArray();
    }
}
