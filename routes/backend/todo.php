<?php

/**
 * All route names are prefixed with 'admin.auth'.
 */
Route::group([
    'namespace'  => 'Todo',
], function () {

    Route::resource('todo', 'TodoController');

});
