<?php

namespace App\Models;

use App\Models\Concerns\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderProduct extends Model
{
    use HasFactory, UsesUuid;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'unit_price',
        'name',
        'brand',
    ];
}
