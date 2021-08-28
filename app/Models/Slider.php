<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
  use \Astrotomic\Translatable\Translatable;
  protected $guarded = [];

  public $translatedAttributes = ['title', 'description'];
  protected $appends = ['image_path'];

  public function getImagePathAttribute()
  {
    return asset('uploads/slider/' . $this->image);
  } //end of image path attribute

  public function scopeWhenPosition($query, $position)
  {
    return $query->when($position, function ($p) use ($position) {

      return $p->where('position', $position);
    });
  }
}
