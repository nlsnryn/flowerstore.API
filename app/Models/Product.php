<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'product_description',
        'price',
        'quantity',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
