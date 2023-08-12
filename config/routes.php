<?php

return [
    '' => 'HomeController@index',
    'shop' => 'ShopController@index',
    'about' => 'AboutController@index',
    'contact' => 'ContactController@index',
    'admin' => 'Admin/DashboardController@index',
    'admin/settings' => 'Admin/SettingController@index',
    'admin/brands' => 'Admin/BrandController@index',
    'admin/brands/create' => 'Admin/BrandController@create',
    'admin/brands/edit' => 'Admin/BrandController@edit',
    'admin/categories' => 'Admin/CategoryController@index',
    'admin/categories/create' => 'Admin/CategoryController@create',
    'admin/categories/edit' => 'Admin/CategoryController@edit',
    'error' => 'ErrorController@index',
];