<?php

namespace App\Models;

use App\Support\Trait\HasPagination;
use App\Support\Trait\HasSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    use HasPagination;
    use HasSearch;

    protected $fillable = [
        'name',
        'color',
    ];

    public function products()
    {
        return $this->morphToMany(Product::class, 'productable');
    }
}
