<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public function subcategory(){
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function product(){
        return $this->hasMany(Product::class, 'brand_id');
    }
}
