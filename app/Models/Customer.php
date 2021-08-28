<?php

namespace App\Models;


use Illuminate\Support\Facades\DB;
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

  public function getRoleNameAttribute()
  {
    return $this->roles()->count() > 0 ? $this->roles()->first()->name : '';
  } //end of image path attribute

  public function getTotalCartAttribute()
  {
    return $this->products->sum('totalCart');
  } //end of image path attribute

  public function products()
  {
    return $this->belongsToMany(Product::class, 'customer_product',  'customer_id', 'product_id')->withPivot(['qty']);
  }

  public function orders()
  {
    return $this->hasMany(Order::class);
  } //end fo category

  public function transfers()
  {
    return $this->hasMany(Transfer::class);
  } //end fo category

  public function complaints()
  {
    return $this->hasMany(Complaint::class);
  } //end fo category

  public function withdrawFunds()
  {
    return $this->hasMany(WithdrawFund::class, 'customer_id', 'id');
  } //end fo category

  public function premiums()
  {
    return $this->hasMany(Premium::class, 'customer_id', 'id');
  } //end fo category

  public function requsetPriceOrders()
  {
    return $this->hasMany(RequestPriceOrder::class);
  } //end fo category

  public function specialQuantities()
  {
    return $this->hasMany(SpecialQuantities::class);
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
  public function customers()
  {
    return $this->hasMany(Customer::class);
  } //end fo category
  public function wallet_history()
  {
    return $this->hasMany(WalletHistory::class);
  } //end fo category

  public function favoirtes()
  {
    return $this->belongsToMany(Product::class, 'favoirtes', 'customer_id', 'product_id');
  }

  public function quantities()
  {
    return $this->belongsToMany(Product::class, 'customer_quantity', 'customer_id', 'product_id')->withPivot(['qty', 'total']);
  }

  public function package()
  {
    return $this->belongsTo(Package::class);
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

}
