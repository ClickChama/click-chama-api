<?php

namespace App\Models;

use App\Models\Concerns\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory, UsesUuid;

    protected $fillable = [
        'seller_id',
        'customer_id',
        'customer_address_id',
        'quantity',
        'total_price',
        'payment_method',
        'payback',
        'status'
    ];

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function seller()
    {
        return $this->hasOne(Seller::class, 'id', 'seller_id');
    }

    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }

    public function customerAddress()
    {
        return $this->hasOne(Address::class, 'id', 'customer_address_id');
    }
}
