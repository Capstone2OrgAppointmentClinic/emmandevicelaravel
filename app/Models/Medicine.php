<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $fillable = [
        'product_name',
        'category',
        'quantity',
        'description',
        'expiry_date',
    ];
}
