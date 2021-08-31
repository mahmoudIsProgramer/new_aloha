<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductSeller extends Model
{
  use HasFactory;

  protected $table = 'product_seller';

  protected $guarded = [];

  protected $appends = ['total'];

  ########################### start attributes ######################################
  public function getTotalAttribute()
  {
    return $this->selling_price - $this->discount;
  } // end of image path attribute

  public function getTotalBladeAttribute()
  {
    return  $this->total . ' ' . config('site_options.currency');
  } // end of image path attribute

  public function getInCartAttribute()
  {

    if ($customer = getCustomer()) {

      return $customer->productSellers->where('id', $this->id)->count() > 0 ? true : false;
    } //end of if

    return false;
  } // end of

  public function getQtyInCartAttribute()
  {

    if ($this->inCart) {

      $productSellers  = getCustomer()->productSellers->where('id', $this->id)->first();

      $qty = $productSellers->pivot->qty;
    }

    return $qty ?? 1;
  } // end of image path attribute

  public function getProductTotalInCartAttribute()
  {
    if ($this->inCart) {
      $total = $this->qtyInCart * $this->total;
    }

    return $total ?? 0;
  } // end of image path attribute

  ########################### end attributes ######################################

  ########################### start relations ######################################
  public function seller()
  {
    return $this->belongsTo(Seller::class);
  } // end of user

  public function product()
  {
    return $this->belongsTo(Product::class);
  } // end of user

  public function customers()
  {
    return $this->belongsToMany(Customer::class, 'customer_product_seller', 'customer_id', 'product_seller_id')->withPivot(['qty']);
  }

  public function orders()
  {
    return $this->belongsToMany(Order::class, 'order_product_seller', 'order_id', 'product_seller_id')->withPivot('qty', 'price', 'price_before_discount', 'total', 'status');
  }

  public function suborders()
  {
    return $this->belongsToMany(Suborder::class, 'suborder_product_seller', 'suborder_id', 'product_seller_id')->withPivot('qty', 'price', 'total', 'status');
  }

  ########################### end relations ######################################

  public function getdiscountPercentAttribute()
  {
    $per =  (1 - ($this->total /  $this->selling_price)) * 100;
    return number_format($per);
  } // end of image path attribute

}
