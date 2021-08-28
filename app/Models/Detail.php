<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
  use \Astrotomic\Translatable\Translatable;
  protected $guarded = [];

  public $translatedAttributes = ['name', 'title', 'description'];
  protected $appends = ['image_path'];

  public function product()
  {
    return $this->belongsTo(Product::class, 'product_id', 'id');
  }
  public function specification()
  {
    return $this->belongsTo(Specification::class, 'specification_id', 'id');
  }
}
