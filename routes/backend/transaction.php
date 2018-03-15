<?php

/**
 * All route names are prefixed with 'admin.auth'.
 */
Route::group([
    'prefix'     => 'client',
    'namespace'  => 'Transaction',
    'as'         => 'client.'
], function () {

    Route::get('{client}/transaction/create', 'TransactionController@create')->name('transaction.create');
    Route::post('transaction/create', 'TransactionController@store')->name('transaction.store');

});
