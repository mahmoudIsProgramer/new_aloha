<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Add extends Model
{
    protected $guarded = [];
    protected $appends = ['image_path'];

    public function getImagePathAttribute()
    {
        return asset('uploads/ads/' . $this->image);
    }//end of image path attribute

    public function addImages()
    {
        return $this->hasMany(AddImage::class);
    }//end of products

}
