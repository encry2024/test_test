<?php

/**
 * All route names are prefixed with 'admin.auth'.
 */
Route::group([
    'namespace'  => 'Inventory',
], function () {

    Route::get('inventory/deleted', 'InventoryStatusController@getDeleted')->name('inventory.deleted');
    Route::get('inventory/{inventory}/item/cart', 'InventoryController@showCart')->name('inventory.cart');

    Route::resource('inventory', 'InventoryController');

    Route::group(['prefix' => 'inventory/{deletedInventory}'], function () {
        Route::get('delete', 'InventoryStatusController@delete')->name('inventory.delete-permanently');
        Route::get('restore', 'InventoryStatusController@restore')->name('inventory.restore');
    });

});
