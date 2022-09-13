<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    public function product_sample_images()
    {
        return $this->hasMany('App\Models\Product_Sample_Image');
    }
}
