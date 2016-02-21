<?php

Route::group(['middleware' => ['web']], function () {
    
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController'
]);

Route::get('/', 'TodosController@index');
Route::get('/home', 'TodosController@index');
Route::get('user/profile/{id}', 'UsersController@profile');
Route::get('user/profile', 'UsersController@profile');
Route::get('todos/add', 'TodosController@create');
Route::get('offer/{todo_id}', 'TodosController@offer');
Route::get('search', 'TodosController@search');
Route::post('todos/store', 'TodosController@store');
Route::get('todos', 'TodosController@mytodos');
Route::get('jobs', 'TodosController@myjobs');
Route::get('inbox/{user_id}', 'MessagesController@inbox');
Route::get('inbox', 'MessagesController@inbox');
Route::get('send_message', 'MessagesController@send');
});
