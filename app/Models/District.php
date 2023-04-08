<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $talbe = 'district';

    protected $fillaable = [
        'district_id',
        'province_id',
        'name',
    ];
    
}
