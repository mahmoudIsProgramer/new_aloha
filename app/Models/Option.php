<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
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
  public function variation()
  {
    return $this->belongsTo(Variation::class)->withDefault(['title' => '']);
  } //end of products
  ######################### end relations   ##########################

}
