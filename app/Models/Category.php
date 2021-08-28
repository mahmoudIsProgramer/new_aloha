<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Project;

class Category extends Model
{
  use \Astrotomic\Translatable\Translatable;

  protected $guarded = [];
  public $translatedAttributes = ['name'];
  protected $appends = ['image_path'];


  public function parent()
  {
    return $this->belongsTo(Category::class, 'parent_id', 'id')->withDefault([
      'name' =>''
    ]);
  }


  public function childs()
  {
    return $this->hasMany(Category::class, 'parent_id', 'id');
  }

  public function products()
  {
    return $this->hasMany(Product::class);
  } //end of products

  public function offers()
  {
    return $this->hasMany(Offer::class);
  } //end of products


  public function parameters()
  {
    return $this->belongsToMany(Parameter::class);
  } //end of products

  public function getImagePathAttribute()
  {
    return asset('uploads/categories/' . $this->image);
  } //end of image path attribute

  public function teachers()
  {
    return $this->hasMany(Teacher::class);
  } //end fo category

  public function subcategories()
  {
    return $this->hasMany(Subcategory::class);
  } //end fo category

  public function scopeActive($query)
  {
    return $query->where('status', 1);
  }

  public function scopeMenu($query)
  {
    return $query->where('menu', 1);
  }

  public function scopeShowOnHomePage($query)
  {
    return $query->where('show_on_home_page', 1);
  }
}//end of model
