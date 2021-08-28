<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use \Astrotomic\Translatable\Translatable;

    protected $guarded = [];
    public $translatedAttributes = ['name'];
    public $table = 'states' ;

    public function regoins()
    {
        return $this->hasMany(Regoin::class);

    }//end of products

    public function city()
    {
        return $this->belongsTo(City::class);

    }//end fo category



    public function centers()
    {
        return $this->hasMany(Center::class);

    }//end of products

    public function customers()
    {
        return $this->hasMany(Customer::class);

    }//end of products

    public function teachers()
    {
        return $this->hasMany(Teacher::class);

    }//end of products


    public function students()
    {
        return $this->hasMany(Student::class);

    }//end of products



}
