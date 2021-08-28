<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
  //
  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $guarded = [''];


  public function customer()
  {
    return $this->belongsTo(Customer::class);
  }

  public function getImagePathAttribute()
  {
    return asset('uploads/complaints/' . $this->image);
  } //end of image path attribute
}
