<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSeller extends Model
{
  use HasFactory;

  protected $table = 'product_seller';

  // protected $appends = ['total'];
  // public function getTotalAttribute()
  // {
  //   return $this->selling_price - $this->discount;
  // } // end of image path attribute

}
