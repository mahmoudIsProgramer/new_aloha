<?php

$modules =  config('asidebar_links.modules');

return [
  'role_structure' => [
    'super_admin' =>  $modules,
  ],
  'permissions_map' => [
    'c' => 'create',
    'r' => 'read',
    'u' => 'update',
    'd' => 'delete'
  ]
];
