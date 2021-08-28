<?php

namespace App\Models;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;

class Promocode extends Model
{

  protected $guarded = [];

  public function discount($total)
  {
    $discount = 0;

    if ($this->type == 'value') {
      $discount =  $this->discount_amount;
    } else {
      $discount =  ($this->discount_amount * 0.01) * $total;
    }

    return $discount;
  }

  public function scopeActive($query)
  {
    return $query->where('status', 1);
  }
}
