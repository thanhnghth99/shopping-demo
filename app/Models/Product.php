<?php

namespace App\Models;

use App\Support\Trait\HasPagination;
use App\Support\Trait\HasSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use HasPagination;
    use HasSearch;
    use SoftDeletes;

    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;

    protected $fillable = [
        'name',
        'description',
        'information',
        'price',
        'discount',
        'status',
    ];
    
    public function subcategories()
    {
        return $this->morphedByMany(SubCategory::class, 'productable');
    }

    public function colors()
    {
        return $this->morphedByMany(Color::class, 'productable');
    }

    public function images()
    {
        return $this->morphedByMany(Image::class, 'productable');
    }

    public function sizes()
    {
        return $this->morphedByMany(Size::class, 'productable');
    }
}
