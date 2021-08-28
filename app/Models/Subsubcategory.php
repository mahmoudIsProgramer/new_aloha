<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subsubcategory extends Model
{
  use \Astrotomic\Translatable\Translatable;

  protected $guarded = [];
  public $translatedAttributes = ['name'];

  public function getImagePathAttribute()
  {
    return asset('uploads/subsubcategories/' . $this->image);
  } //end of image path attribute


  public function getBigImagePathAttribute()
  {
    return asset('uploads/subsubcategories/' . $this->big_image);
  } //end of image path attribute

  public function subcategory()
  {
    return $this->belongsTo(Subcategory::class)->withDefault([
      'name' => ''
    ]);
  } //end of products

  public function vendors()
  {
    return $this->hasMany(Vendor::class);
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
