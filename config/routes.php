<?php

return [
    '' => 'HomeController@index',
    'shop' => 'ShopController@index',
    'about' => 'AboutController@index',
    'contact' => 'ContactController@index',
    'admin' => 'Admin\DashboardController@index',
    'admin/settings' => 'Admin\SettingController@index',
    'admin/brands' => 'Admin\BrandController@index',
    'admin/brands/create' => 'Admin\BrandController@create',
    'admin/brands/store' => 'Admin\BrandController@store',
    'admin/brands/edit/{id}' => 'Admin\BrandController@edit',
    'admin/brands/destroy/{id}' => 'Admin\BrandController@destroy',
    'admin/brands/update' => 'Admin\BrandController@update',
    
    'admin/categories' => 'Admin\CategoryController@index',
    'admin/categories/store' => 'Admin\CategoryController@store',
    'admin/categories/create' => 'Admin\CategoryController@create',
    'admin/categories/edit/{id}' => 'Admin\CategoryController@edit',
    'admin/categories/destroy/{id}' => 'Admin\CategoryController@destroy',
    'admin/categories/update' => 'Admin\CategoryController@update',
    
    'error' => 'ErrorController@index',
];