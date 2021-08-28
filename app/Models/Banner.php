<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{

  use \Astrotomic\Translatable\Translatable;
  protected $guarded = [];

  public $translatedAttributes = ['title', 'description', 'short_description'];
  protected $appends = ['image_path'];

  public function getImagePathAttribute()
  {
    return asset('uploads/banners/' . $this->image);
  } //end of image path attribute

  public function getIsActiveAttribute()
  {
    return $this->status == '1' ? true : false;
  }

  public function scopeActive($query)
  {
    return $query->where('status', 1);
  }

  public function scopeBannerLocation($query, $value)
  {
    return $query->where('bannerLocation', $value);
  }


}
