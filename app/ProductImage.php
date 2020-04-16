<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = "product_files";

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }

    protected $appends = ['filePath'];

    public function getFilePathAttribute()
    {
        return url(asset('/storage/' . $this->path));
    }
}
