<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{

  use \Astrotomic\Translatable\Translatable;

  protected $guarded = [];
  public $translatedAttributes = ['name'];

  public function states()
  {
    return $this->hasMany(State::class);
  } //end of products

  public function deliveries()
  {
    return $this->hasMany(Delivery::class, 'city_id', 'id');
  } //end of products


  public function centers()
  {
    return $this->hasMany(Center::class);
  } //end of products

  public function orders()
  {
    return $this->hasMany(Order::class);
  }

  public function schools()
  {
    return $this->hasMany(School::class);
  } //end of products

  public function teachers()
  {
    return $this->hasMany(Teacher::class);
  } //end of products


  public function students()
  {
    return $this->hasMany(Student::class);
  } //end of products



}
