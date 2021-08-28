<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StateTranslation extends Model
{
  public $fillable  = ['name'];
  public $table =   'state_translations';
  public $timestamps = false;
}
