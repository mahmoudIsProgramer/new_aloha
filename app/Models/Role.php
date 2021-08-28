<?php

namespace App\Models;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
  use \Astrotomic\Translatable\Translatable;
  public $translatedAttributes = ['title', 'description'];

  protected $guarded = [];

  public function getTotalAttribute()
  {

    return  $this->sale_price - $this->discount;
  } // end of image path attribute

  public function getTotalBladeAttribute()
  {
    $html = $this->total . ' ' . config('site_options.currency');
    if ($this->discount != 0) {
      $html .= " <del>" . $this->sale_price . "</del>";
    }

    return  $html;
  } // end of image path attribute


  //scopes ------------------------------------------
  public function scopeWhenSearch($query, $search)
  {
    return $query->when($search, function ($q) use ($search) {
      return $q->where('name', 'like', "%$search%");
    });
  } // end of scopeWhenSearch

  public function scopeWhereRoleNot($query, $role_name)
  {
    return $query->whereNotIn('name', (array)$role_name);
  } // end of scopeWhereRoleNot


  public function scopeActive($query)
  {
    return $query->where('status', 1);
  }
}//end of model
