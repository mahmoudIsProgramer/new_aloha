<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variation extends Model
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

  ######################### start relations #########################
  public function options()
  {
    return $this->hasMany(Option::class);
  } //end of products
  ######################### end relations   ##########################

}
