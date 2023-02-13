<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'category_id',
        'price_old',
        'price_new',
        'quantity',
        'description',
        'supplier_id',
    ];

    protected $cast = [
        'created_at' => 'd/m/yyyy',
        'updated_at' => 'd/m/yyyy',
    ];
}
