<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table = 'sub_categories';
    protected $guarded = [];
    public function category(){
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function brands(){
        return $this->hasMany(Brand::class, 'sub_category_id');
    }

    public function products(){
        return $this->hasMany(Product::class, 'sub_category_id');
    }
}
