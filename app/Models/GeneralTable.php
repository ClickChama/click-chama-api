<?php

namespace App\Models;

use App\Models\Concerns\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GeneralTable extends Model
{
    use HasFactory, UsesUuid;

    protected $fillable = [
        'table',
        'collumn',
        'value',
        'sub_value_text',
        'sub_value_array',
    ];

    protected $casts = [
        'sub_value_array' => 'array',
    ];
}
