<?php

/**
 * All route names are prefixed with 'admin.auth'.
 */
Route::group([
    'namespace'  => 'Transaction',
], function () {

    Route::group([
        'prefix'     => 'client',
        'as'         => 'client.'
    ], function() {
        # Manually created Route::Resource
        Route::get('{client}/transaction/create', 'TransactionController@create')->name('transaction.create');
        Route::post('transaction/create', 'TransactionController@store')->name('transaction.store');
        Route::get('transaction/{transaction}', 'TransactionController@show')->name('transaction.show');
        Route::delete('{client}/transaction/{transaction}/destroy', 'TransactionController@destroy')->name('transaction.destroy');
    });

    Route::get('transactions', 'TransactionController@index')->name('transactions.index');

});