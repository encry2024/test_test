<?php

/**
 * All route names are prefixed with 'admin.auth'.
 */
Route::group([
    'namespace'  => 'Transaction',
], function () {

    Route::patch('transaction/{transaction}/change_status', 'TransactionController@changeStatus')->name('transaction.received');

    Route::resource('transaction', 'TransactionController');

});
