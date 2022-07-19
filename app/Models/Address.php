<?php

namespace App\Models;

use App\Models\Concerns\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory, UsesUuid;

    protected $fillable = [
        'customer_id',
        'address',
        'number',
        'complement',
        'district',
        'city',
        'state',
        'zip_code',
        'lat',
        'lng',
    ];
}
