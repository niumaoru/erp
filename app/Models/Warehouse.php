<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;

class Warehouse extends Model
{
    protected $fillable = [
        'sort', 'api_type', 'warehouse_number', 'warehouse_name',
        'province', 'city', 'district', 'address', 'contact_name', 'contact_phone',
        'warehouse_type', 'defect_warehouse'
    ];

    protected $casts = ['defect_warehouse' => 'boolean'];
}
