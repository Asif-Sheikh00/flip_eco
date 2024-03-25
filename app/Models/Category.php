<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $fillable = ['parent_category_id', 'name', 'image', 'slug', 'description', 'visibility', 'meta_title', 'meta_description', 'meta_keywords'];
}
