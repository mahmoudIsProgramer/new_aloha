<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
  use \Astrotomic\Translatable\Translatable;

  protected $guarded = [];
  public $translatedAttributes = ['name', 'title', 'description', 'short_description'];
  protected $appends = ['image_path'];

  ######################### start scopes #########################
  public function scopeWhenSearch($query, $search)
  {
    return $query->when($search, function ($q) use ($search) {

      return $q->whereTranslationLike('title', '%' . $search . '%');
    });
  } // end of scopeWhenSearch
  ######################### end scopes   ##########################

  ######################### start relationships    ##########################
  public function products()
  {
    return $this->hasMany(Product::class);
  }
  ######################### end relationships    ##########################

}
