<?php

Auth::routes();
Route::group(['middleware' => ['isVerified','auth']], function(){
    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index')->name('home');
});


// All task methods
Route::group([  'as' => 'task.',
                'prefix' => 'task',
                'middleware' => ['isVerified','auth']
], function(){
    Route::post('/change_state', 'TaskController@change_state')->name('change.state');
    Route::get('/edit/{id}', 'TaskController@edit')->name('edit');
    Route::post('/update', 'TaskController@update')->name('update');
    Route::get('/add', 'TaskController@add')->name('add');
    Route::post('/save', 'TaskController@save')->name('save');
    Route::get('/delete/{id}', 'TaskController@delete')->name('delete');

    Route::get('/task_table_cvs', 'TaskController@cvs_table');
    Route::get('/task_table_xml', 'TaskController@xml_table');

});

// All users methods
Route::group([  'as' => 'users.',
                'prefix' => 'users',
                'middleware' => ['isVerified','auth']
], function(){
    Route::get('/list', 'UsersController@list_all')->name('users.list');
    Route::get('/edit/{id}', 'UsersController@edit')->name('edit');
    Route::post('/update', 'UsersController@update')->name('update');
    Route::get('/delete/{id}', 'UsersController@delete')->name('delete');
});
