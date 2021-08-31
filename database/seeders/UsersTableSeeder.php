<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Inbox;
use App\Models\SiteOption;
use App\Models\SocailMedia;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {

    #super_admin
    $user = User::create([
      'first_name' => 'super',
      'last_name' => 'admin',
      'email' => 'super_admin@app.com',
      'password' => bcrypt('123456'),
    ]);

    $user->attachRole('super_admin');

    #super_admin aloha
    $user = User::create([
      'first_name' => 'super',
      'last_name' => 'admin',
      'email' => 'super_admin@aloha.com',
      'password' => bcrypt('123456'),
    ]);

    $user->attachRole('super_admin');

    $Inbox = Inbox::create(
      [
        'name' => 'Jon Due',
        'phone' => '0123456789',
        'email' => 'info@domain.com',
        'message' => 'Your message',
        'state' => 2,

      ]
    );

    $Inbox = Inbox::create(
      [
        'name' => 'Basem Galal ',
        'phone' => '456789321',
        'email' => 'info@Gamil.com',
        'message' => 'Your message',
        'state' => 2,
      ]

    );
    $SiteOption = SiteOption::create(
      [
        'num1' => '0123456789',
        'email' => 'info@domain.com',
        // 'seo_tit' => 'title web site',
      ]

    );

    //////sociall Media seed
    $social = SocailMedia::create(
      [
        'name' => 'facebook',
        'link' => '',
        'icon' => 'fa-facebook',
      ]

    );

    $social = SocailMedia::create(
      [
        'name' => 'twitter',
        'link' => '',
        'icon' => 'fa-twitter',
      ]

    );
    $social = SocailMedia::create(
      [
        'name' => 'instagram',
        'link' => '',
        'icon' => 'fa-instagram',
      ]

    );
    $social = SocailMedia::create(
      [
        'name' => 'snapchat',
        'link' => '',
        'icon' => 'fa-snapchat',
      ]

    );
    $social = SocailMedia::create(
      [

        'name' => 'linkedin',
        'link' => '',
        'icon' => 'fa-linkedin-in',
      ]
    );

    $social = SocailMedia::create(
      [
        'name' => 'youtube',
        'link' => '',
        'icon' => 'fa-youtube',
      ]
    );

    $social = SocailMedia::create(
      [
        'name' => 'google',
        'link' => '',
        'icon' => 'fa-google-plus',
      ]
    );
  } //end of run

}//end of seeder
