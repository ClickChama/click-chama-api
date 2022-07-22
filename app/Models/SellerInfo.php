<?php

namespace App\Models;

use App\Models\Concerns\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SellerInfo extends Model
{
    use HasFactory, UsesUuid;

    protected $fillable = [
        'seller_id',
        'app_name',
        'app_phone',
        'cnpj',
        'corporate_name',
        'address',
        'number',
        'complement',
        'district',
        'city',
        'state',
        'zip_code',
        'delivery_radius',
        'delivery_time',
        'lat',
        'lng',
        'delivery_radius',
        'delivery_time',
    ];
}
