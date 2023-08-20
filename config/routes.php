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
    
    'admin/badges' => 'Admin\BadgeController@index',
    'admin/badges/create' => 'Admin\BadgeController@create',
    'admin/badges/store' => 'Admin\BadgeController@store',
    'admin/badges/edit/{id}' => 'Admin\BadgeController@edit',
    'admin/badges/destroy/{id}' => 'Admin\BadgeController@destroy',
    'admin/badges/update' => 'Admin\BadgeController@update',

    'admin/sections' => 'Admin\SectionController@index',
    'admin/sections/create' => 'Admin\SectionController@create',
    'admin/sections/store' => 'Admin\SectionController@store',
    'admin/sections/edit/{id}' => 'Admin\SectionController@edit',
    'admin/sections/destroy/{id}' => 'Admin\SectionController@destroy',
    'admin/sections/update' => 'Admin\SectionController@update',

    'admin/categories' => 'Admin\CategoryController@index',
    'admin/categories/store' => 'Admin\CategoryController@store',
    'admin/categories/create' => 'Admin\CategoryController@create',
    'admin/categories/edit/{id}' => 'Admin\CategoryController@edit',
    'admin/categories/destroy/{id}' => 'Admin\CategoryController@destroy',
    'admin/categories/update' => 'Admin\CategoryController@update',

    'admin/products' => 'Admin\ProductController@index',
    'admin/products/create' => 'Admin\ProductController@create',
    'admin/products/store' => 'Admin\ProductController@store',
    'admin/products/edit/{id}' => 'Admin\ProductController@edit',
    'admin/products/destroy/{id}' => 'Admin\ProductController@destroy',
    'admin/products/update' => 'Admin\ProductController@update',
    
    'error' => 'ErrorController@index',
];