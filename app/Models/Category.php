<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'category_name',
        'category_image',
        'category_tagline',
        'updated_at',
        'status',
    ];

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
}
