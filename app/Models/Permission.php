<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;
    
    protected $fillable= [
        'name',
        'status',
    ];
}
