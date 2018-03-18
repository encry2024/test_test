<?php

/**
 * All route names are prefixed with 'admin.auth'.
 */
Route::group([
    'namespace'  => 'Distributor',
], function () {

    Route::get('distributor/deleted', 'DistributorStatusController@getDeleted')->name('distributor.deleted');
    Route::get('distributor/{distributor}/item/cart', 'DistributorController@showCart')->name('distributor.cart');
    Route::get('distributor/{distributor}/inventory/create', 'DistributorController@createInventory')->name('distributor.inventory.create');
    Route::post('distributor/inventory/store', 'DistributorController@storeInventory')->name('distributor.inventory.store');
    Route::post('distributor/get_inventory', 'DistributorController@getInventory')->name('distributor.get_inventory');

    Route::resource('distributor', 'DistributorController');

    Route::group(['prefix' => 'distributor/{deletedDistributor}'], function () {
        Route::get('delete', 'DistributorStatusController@delete')->name('distributor.delete-permanently');
        Route::get('restore', 'DistributorStatusController@restore')->name('distributor.restore');
    });

});
