<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $guarded =[];

    // protected $table = 'product_images';
    public function product()
    {
        return $this->belongsTo(Product::class);
    }//end of user

    public function getImagePathAttribute()
    {
        return asset('uploads/product_images/' . $this->image);

    } //end of get image path

}
