<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteOption extends Model
{

  use \Astrotomic\Translatable\Translatable;

  protected $guarded = [];
  // protected $table = "site_options" ;
  public $translatedAttributes = ['address', 'description_delivery_info', 'title_delivery_info', 'title_return_policy_info', 'description_return_policy_info', 'description_security_info', 'title_security_info', 'address2', 'tit_info', 'des_info', 'tit_video_en', 'tit_video_ar', 'working_time', 'seo_tit', 'seo_key', 'seo_des', 'seo_google_analatic', 'winWheelGuidlines', 'copyRights'];



  public function getIconPathAttribute()
  {
    return asset('uploads/site_options/' . $this->icon);
  } //end of image path attribute

  public function getLogoPathAttribute()
  {
    return asset('uploads/site_options/' . $this->logo);
  } //end of image path attribute

}
