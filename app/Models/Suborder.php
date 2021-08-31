<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suborder extends Model
{
  use HasFactory;
  protected $guarded = [];

  public function order()
  {
    return $this->belongsTo(Order::class);
  }

  public function seller()
  {
    return $this->belongsTo(Seller::class);
  }

  public function productSellers()
  {
    return $this->belongsToMany(ProductSeller::class, 'suborder_product_seller', 'suborder_id', 'product_seller_id')->withPivot('qty', 'price', 'total', 'status');
  }
}
