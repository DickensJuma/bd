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
        return $this->where('brand_id', $brand_id);
    }

    public function subcategory($sub_category_id)
    {
        return $this->where('brand_id', $sub_category_id);
    }

    public function title($title)
    {
        return $this->where(function($q) use ($title)
        {
            return $q->where('title', 'LIKE', "%$title%");
        });
    }
}
