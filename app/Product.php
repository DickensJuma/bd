<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;

class Product extends Model
{
    use Filterable;

    public function brand(){
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function category(){
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }
    public function wholesaler(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function files(){
        return $this->hasMany(ProductImage::class, 'product_id');
    }
    public function orderItem(){
        return $this->hasone(orderItem::class, 'product_id');
    }

    public function subcategory(){
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }
}
