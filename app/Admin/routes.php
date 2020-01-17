<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');

    //仓库资源路由
    $router->resource('warehouses', WarehousesController::class);

    //品牌资源路由
    $router->resource('brands', BrandsController::class);

    //产品资源路由
    $router->resource('products', ProductsController::class);

    //电商平台资源路由
    $router->resource('platforms', PlatformsController::class);

    //店铺资源路由
    $router->resource('shops', ShopsController::class);
});
