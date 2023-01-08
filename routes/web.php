<?php

Route::redirect('/', '/login');

Route::redirect('/home', '/admin');

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');

    Route::resource('permissions', 'PermissionsController');

    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');

    Route::resource('roles', 'RolesController');

    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');

    Route::resource('users', 'UsersController');

    Route::delete('products/destroy', 'ProductsController@massDestroy')->name('products.massDestroy');

    Route::resource('products', 'ProductsController');

    //Category
    Route::get('/cat', 'CategoryController@showData')->name('cat.index');
    Route::get('/cat/add-data', 'CategoryController@addData')->name('cat.add');
    Route::get('/cat/edit-data/{id}', 'CategoryController@editData')->name('cat.edit');
    Route::post('/cat/store-data', 'CategoryController@storeData')->name('cat.store');
    Route::post('/cat/update-data/{id}', 'CategoryController@updateData')->name('cat.update');
    Route::delete('/cat/delete-data/{id}', 'CategoryController@deleteData')->name('cat.delete');




    //Supplier
    Route::get('/sup', 'SupplierController@showData')->name('sup.index');
    Route::get('/sup/add-data', 'SupplierController@addData')->name('sup.add');
    Route::get('/sup/edit-data/{id}', 'SupplierController@editData')->name('sup.edit');
    Route::post('/sup/store-data', 'SupplierController@storeData')->name('sup.store');
    Route::post('/sup/update-data/{id}', 'SupplierController@updateData')->name('sup.update');
    Route::delete('/sup/delete-data/{id}', 'SupplierController@deleteData')->name('sup.delete');



    //Purchase
    Route::get('/pur', 'PurchaseController@showData')->name('pur.index');
    Route::get('/pur/add-data', 'PurchaseController@addData')->name('pur.add');
    Route::get('/pur/edit-data/{id}', 'PurchaseController@editData')->name('pur.edit');
    Route::post('/pur/store-data', 'PurchaseController@storeData')->name('pur.store');
    Route::post('/pur/update-data/{id}', 'PurchaseController@updateData')->name('pur.update');
    Route::get('/pur/delete-data/{id}', 'PurchaseController@deleteData')->name('pur.delete');
    Route::get('/pur/delete-item/{id}', 'PurchaseController@deleteItem')->name('pur.dlt');
    Route::get('/pur/getProductById/{id}', 'PurchaseController@getProductById')->name('pur.getProductById');



    //Customer
    Route::get('/cus', 'CustomerController@showData')->name('cus.index');
    Route::get('/cus/add-data', 'CustomerController@addData')->name('cus.add');
    Route::get('/cus/edit-data/{id}', 'CustomerController@editData')->name('cus.edit');
    Route::post('/cus/store-data', 'CustomerController@storeData')->name('cus.store');
    Route::post('/cus/update-data/{id}', 'CustomerController@updateData')->name('cus.update');
    Route::delete('/cus/delete-data/{id}', 'CustomerController@deleteData')->name('cus.delete');




    //Sell
    Route::get('/sell', 'SellController@showData')->name('sell.index');
    Route::get('/sell/add-data', 'SellController@addData')->name('sell.add');
    Route::get('/sell/edit-data/{id}', 'SellController@editData')->name('sell.edit');
    Route::post('/sell/store-data', 'SellController@storeData')->name('sell.store');
    Route::post('/sell/update-data/{id}', 'SellController@updateData')->name('sell.update');
    Route::get('/sell/delete-data/{id}', 'SellController@deleteData')->name('sell.delete');
    Route::get('/sell/delete-item/{id}', 'SellController@deleteItem')->name('sell.dlt');
    Route::get('/sell/getProductById/{id}', 'SellController@getProductById')->name('sell.getProductById');





    //Unit of measarement
    Route::get('/uom', 'UnitOfMeasarementController@showData')->name('uom.index');
    Route::get('/uom/add-data', 'UnitOfMeasarementController@addData')->name('uom.add');
    Route::get('/uom/edit-data/{id}', 'UnitOfMeasarementController@editData')->name('uom.edit');
    Route::post('/uom/store-data', 'UnitOfMeasarementController@storeData')->name('uom.store');
    Route::post('/uom/update-data/{id}', 'UnitOfMeasarementController@updateData')->name('uom.update');
    Route::delete('/uom/delete-data/{id}', 'UnitOfMeasarementController@deleteData')->name('uom.delete');




    //Brand
    Route::get('/brn', 'BrandController@showData')->name('brn.index');
    Route::get('/brn/add-data', 'BrandController@addData')->name('brn.add');
    Route::get('/brn/edit-data/{id}', 'BrandController@editData')->name('brn.edit');
    Route::post('/brn/store-data', 'BrandController@storeData')->name('brn.store');
    Route::post('/brn/update-data/{id}', 'BrandController@updateData')->name('brn.update');
    Route::delete('/brn/delete-data/{id}', 'BrandController@deleteData')->name('brn.delete');


    





});
