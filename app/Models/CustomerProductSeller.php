<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerProductSeller extends Model
{
  use HasFactory;
  protected $table = 'customer_product_seller';
  protected $guarded = [];
}
