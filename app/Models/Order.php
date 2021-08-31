<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  protected $guarded = [];

  ########################### start relations ######################################
  public function customer()
  {
    return $this->belongsTo(Customer::class);
  } //end fo category

  public function products()
  {
    return $this->belongsToMany(Product::class, 'order_product', 'order_id', 'product_id')->withPivot('qty', 'price', 'price_before_discount', 'total', 'status');
  } // end of parameters

  public function address()
  {
    return $this->belongsTo(Address::class);
  }

  public function productSellers()
  {
    return $this->belongsToMany(ProductSeller::class, 'order_product_seller', 'order_id', 'product_seller_id')->withPivot('qty', 'price', 'price_before_discount', 'total', 'status');
  }
  public function subOrders()
  {
    return $this->hasMany(Suborder::class);
  }

  ########################### end relations ######################################

}
