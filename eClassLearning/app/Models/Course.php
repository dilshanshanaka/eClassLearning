<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    // Main Category
    public function mainCategory()
    {
        return $this->hasOneThrough(
            MainCategory::class,
            SubCategory::class,
            'id',
            'id',
            'sub_category_id',
            'main_category_id'
        );
    }

    // Sub Category
    public function subCategory()
    {
        return $this->hasOne(
            SubCategory::class,
            'id',
            'sub_category_id'
        );
    }
}
