<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{

  use SoftDeletes;


  use LaratrustUserTrait;
  use Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'first_name', 'last_name', 'email', 'password', 'image', 'aboutUser'
  ];

  #updated or crated by
  public function products()
  {
    return $this->hasMany(Product::class);
  } //end fo category


  protected $appends = ['image_path', 'full_name'];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */

  protected $hidden = [
    'password', 'remember_token',
  ];

  public function getFullNameAttribute($value)
  {
    return $this->first_name . " " . $this->last_name;
  } //end of get first name
  public function getFirstNameAttribute($value)
  {
    return ucfirst($value);
  } //end of get first name

  public function getLastNameAttribute($value)
  {
    return ucfirst($value);
  } //end of get last name

  public function getImagePathAttribute()
  {
    return asset('uploads/user_images/' . $this->image);
  } //end of get image path

  public function blogs()
  {
    return $this->hasMany(Blogs::class, 'created_by_id', 'id');
  } //end fo category

  //scopes ---------------------------------
  public function scopeWhenSearch($query, $search)
  {
    return $query->when($search, function ($q) use ($search) {
      // return $q->where('name', 'like', "%$search%");
      return $q->where('first_name', 'like', "%$search%")->orWhere('last_name', 'like', "%$search%");
    });
  } // end of scopeWhenSearch

  public function scopeWhenRole($query, $role_id)
  {
    return $query->when($role_id, function ($q) use ($role_id) {
      return $this->scopeWhereRole($q, $role_id);
    });
  } // end of scopeWhenRole

  public function scopeWhereRole($query, $role_name)
  {
    return $query->whereHas('roles', function ($q) use ($role_name) {
      return $q->whereIn('name', (array)$role_name)
        ->orWhereIn('id', (array)$role_name);
    });
  } // end of scopeWhereRole

  public function scopeWhereRoleNot($query, $role_name)
  {
    return $query->whereHas('roles', function ($q) use ($role_name) {
      return $q->whereNotIn('name', (array)$role_name)
        ->whereNotIn('id', (array)$role_name);
    });
  } // end of scopeWhereRoleNot


}//end of model
