<?php

namespace App\Models;

use App\Support\Trait\HasPagination;
use App\Support\Trait\HasSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use HasFactory;
    use HasPagination;
    use HasSearch;
    use SoftDeletes;

    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;

    protected $fillable = [
        'name',
        'status',
        'category_id',
    ];

    /**
     * Get the category that owns the subcategory.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
