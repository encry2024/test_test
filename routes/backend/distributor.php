<?php

/**
 * All route names are prefixed with 'admin.auth'.
 */
Route::group([
    'namespace'  => 'Distributor',
], function () {

    Route::get('distributor/deleted', 'DistributorStatusController@getDeleted')->name('distributor.deleted');
    Route::get('distributor/{distributor}/item/cart', 'DistributorController@showCart')->name('distributor.cart');

    Route::resource('distributor', 'DistributorController');

    Route::group(['prefix' => 'distributor/{deletedDistributor}'], function () {
        Route::get('delete', 'DistributorStatusController@delete')->name('distributor.delete-permanently');
        Route::get('restore', 'DistributorStatusController@restore')->name('distributor.restore');
    });

});
