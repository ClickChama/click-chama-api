<?php

namespace App\Models;

use App\Models\Concerns\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, UsesUuid;

    protected $fillable = [
        'seller_id',
        'brand',
        'type',
        'price',
        'product_type'
    ];
}
