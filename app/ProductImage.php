<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = "product_images";

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }

    protected $appends = ['filePath', 'largePath'];

    public function getFilePathAttribute()
    {
        return url(asset('/storage/uploads/' . $this->path));
    }

    public function getlargePathAttribute()
    {
        return url(asset('/storage/uploads/large/' . $this->path));
    }
}
