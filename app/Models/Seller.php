<?php

namespace App\Models;


use Illuminate\Support\Facades\DB;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Seller extends  Authenticatable
{

  use LaratrustUserTrait, HasApiTokens, Notifiable;

  protected $guarded = [];

  public function getImagePathAttribute()
  {
    return asset('uploads/sellers/' . $this->image);
  } //end of image path attribute

  public function products()
  {
    return $this->belongsToMany(Product::class, 'product_seller', 'seller_id', 'product_id')->withPivot([
      'stock', 'selling_price', 'discount', 'sku', 'seller_notes', 'status',
      // 'importance'
    ]);
  }

  public function orders()
  {
    return $this->hasMany(Order::class);
  } //end fo category

  public function complaints()
  {
    return $this->hasMany(Complaint::class);
  } //end fo category



  public function reviews()
  {
    return $this->hasMany(Review::class);
  } //end fo category

  public function city()
  {
    return $this->belongsTo(City::class)->withDefault([
      'name' => '',
    ]);;
  } //end fo category

  public function state()
  {
    return $this->belongsTo(State::class)->withDefault([
      'name' => '',
    ]);
  } // end fo category

  ###################### start scopes ######################
  public function scopeActive($query)
  {
    return $query->where('status', 1);
  }

  public function scopeWhenStatus($query, $status)
  {
    if ($status != null) {
      return $query->where('status', $status);
    }
  }

  public function scopeWhenSearch($query, $search)
  {
    return $query->where('full_name', 'like', '%' . $search . '%')
      ->orwhere('company_name', 'like', '%' . $search . '%')
      ->orwhere('phone', 'like', '%' . $search . '%')
      ->orwhere('email', 'like', '%' . $search . '%');
  } // end of scopeWhenSearch
  ###################### end scopes ######################


}
