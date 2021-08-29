<?php

namespace App\Models;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductSeller extends Model
{
  use HasFactory;

  protected $table = 'product_seller';

  protected $appends = ['total'];

  ########################### start attributes ######################################
  public function getTotalAttribute()
  {
    return $this->selling_price - $this->discount;
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
  ########################### end relations ######################################
  ########################### start attributes ######################################
  public function getInCartAttribute()
  {

    if ($customer = getCustomer()) {

      return $customer->productSellers->where('id', $this->id)->count() > 0 ? true : false;
    } //end of if

    return false;
  } // end of getIsFavoredAttribute

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

    // Log::info($this->qty_in_cart);
    // Log::info($this->in_cart);
    // Log::info($this->total);
    if ($this->inCart) {
      $total = $this->qty_in_cart * $this->total;
    }

    return $total ?? 0;
  } // end of image path attribute
  ########################### end attributes ######################################

}
