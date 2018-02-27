<?php

/**
 * All route names are prefixed with 'admin.auth'.
 */
Route::group([
    'namespace'  => 'Client',
], function () {

    Route::get('client/deleted', 'ClientStatusController@getDeleted')->name('client.deleted');
    Route::get('client/{client}/item/cart', 'ClientController@showCart')->name('client.cart');

    Route::resource('client', 'ClientController');

    Route::group(['prefix' => 'client/{deletedClient}'], function () {
        Route::get('delete', 'ClientStatusController@delete')->name('client.delete-permanently');
        Route::get('restore', 'ClientStatusController@restore')->name('client.restore');
    });

});
