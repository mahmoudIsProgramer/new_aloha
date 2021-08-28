<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class  Subcategory extends Model
{
  use \Astrotomic\Translatable\Translatable;

  protected $guarded = [];
  public $translatedAttributes = ['name'];

  public function getImagePathAttribute()
  {
    return asset('uploads/subcategories/' . $this->image);
  } //end of image path attribute

  public function category()
  {
    return $this->belongsTo(Category::class);
  } //end of products

  public function subsubcategories()
  {
    return $this->hasMany(Subsubcategory::class);
  } //end of products

  public function offers()
  {
    return $this->hasMany(Offer::class);
  } //end of products

  public function products()
  {
    return $this->hasMany(Product::class);
  } //end of products

  public function scopeActive($query)
  {
    return $query->where('status', 1);
  }
}
