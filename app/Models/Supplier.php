<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'address',
        'telephone',
        'email',
    ];
    
    protected $cast = [
        'created_at' => 'd/m/yyyy',
        'updated_at' => 'd/m/yyyy',
    ];
}
