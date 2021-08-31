<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends  Authenticatable
{

  use LaratrustUserTrait, HasApiTokens, Notifiable;

  protected $guarded = [];

  public function getImagePathAttribute()
  {
    return asset('uploads/customers/' . $this->image);
  } //end of image path attribute

  public function getTotalCartAttribute()
  {
    return $this->productSellers->sum('productTotalInCart');
  } //end of image path attribute

  public function productSellers()
  {
    return $this->belongsToMany(ProductSeller::class, 'customer_product_seller', 'customer_id', 'product_seller_id')->withPivot(['qty']);
  }

  public function orders()
  {
    return $this->hasMany(Order::class);
  } //end fo category

  public function addresses()
  {
    return $this->hasMany(Address::class);
  } //end fo category

  public function complaints()
  {
    return $this->hasMany(Complaint::class);
  } //end fo category

  public function favoirtes()
  {
    return $this->belongsToMany(Product::class, 'favoirtes', 'customer_id', 'product_id');
  }

  public function reviews()
  {
    return $this->hasMany(Review::class);
  } //end fo category

  public function city()
  {
    return $this->belongsTo(City::class);
  } //end fo category

  public function state()
  {
    return $this->belongsTo(State::class)->withDefault([
      'name' => '',
    ]);
  } // end fo category

  public function regoin()
  {
    return $this->belongsTo(Regoin::class);
  } //end fo category
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
      ->orwhere('phone', 'like', '%' . $search . '%')
      ->orwhere('email', 'like', '%' . $search . '%');
  } // end of scopeWhenSearch
  ###################### end scopes ######################

}
