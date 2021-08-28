<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use \Astrotomic\Translatable\Translatable;
    protected $guarded = [];
    protected $appends = ['image_path'];
    public $translatedAttributes = ['name'];

    public function getImagePathAttribute()
    {
        return asset('uploads/brands/' . $this->image);
    } //end of image path attribute

    public function products()
    {
        return $this->hasMany(Product::class);
    }//end of products

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }//end of products

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }



}
