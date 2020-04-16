<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'product_category';
    protected $guarded = [];

    public function subCategory(){
        return $this->hasMany(SubCategory::class, 'product_category_id');
    }

    public function products(){
        return $this->hasMany(Product::class, 'category_id');
    }

    protected $appends = ['filePath'];

    public function getFilePathAttribute()
    {
        return asset('img/products_category/' . $this->image);
    }
}
