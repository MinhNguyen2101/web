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
        'status'
    ];

    protected $cast = [
        'created_at' => 'd/m/yyyy',
        'updated_at' => 'd/m/yyyy',
    ];

    public function category()
    {
        return $this->belongsTo(
            Category::class,
            'category_id',
            'id'
        );
    }

    public function supplier()
    {
        return $this->belongsTo(
            Supplier::class,
            'supplier_id',
            'id'
        );
    }
}
