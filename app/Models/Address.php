<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
  use HasFactory;

  protected $guarded = [];

  public function customer()
  {
    return $this->belongsTo(Customer::class);
  } //end fo category

  public function orders()
  {
    return $this->hasMany(Order::class);
  } //end fo category
}
