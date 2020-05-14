<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class ProductFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function brand($brand_id)
    {
        return $this->orderBy('visitors', 'Desc')->where('brand_id', $brand_id)->whereHas('wholesaler.shop', function ($query){
            $query->where('verification', 'verified');
        });
    }

    public function subcategory($sub_category_id)
    {
        return $this->orderBy('visitors', 'Desc')->where('sub_category_id', $sub_category_id)->whereHas('wholesaler.shop', function ($query){
            $query->where('verification', 'verified');
        });
    }

    public function title($title)
    {
        return $this->where(function($q) use ($title)
        {
            return $q->orderBy('visitors', 'Desc')->where('title', 'LIKE', "%$title%")->whereHas('wholesaler.shop', function ($query){
                $query->where('verification', 'verified');
            });
        });
    }

    public function category($category_id){
        return $this->orderBy('visitors', 'Desc')->where('category_id', $category_id)->whereHas('wholesaler.shop', function ($query){
            $query->where('verification', 'verified');
        });
    }
}
