<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//For Non Auth Or Public Demand

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
Route::group(['middleware' => ['web']], function () {
    /**/

    Route::get('/','Auth\AuthController@getLogin');


    //Route Auth
    Route::get('login', 'Auth\AuthController@getLogin');
    Route::post('login', 'Auth\AuthController@postLogin');
    Route::get('logout', 'Auth\AuthController@getLogout');


    Route::get('dashboard','DashboardController@index');

    Route::get('project','ProjectController@showall');
    Route::get('project/detail/{id}','ProjectLogsController@index');

    //Middleware Was Attached In The Controller Object
    Route::post('project/detail/task/addtask','ProjectLogsController@addTask');
    Route::post('project/detail/task/update','ProjectLogsController@update');


    //CEO And Leader Privillage Area
    Route::group(['middleware' => ['auth','ceo']],function(){
        Route::get('users','UserController@index');
        Route::post('users/create','UserController@addUser');
        Route::post('users/update','UserController@update');

        Route::get('project/addproject','ProjectController@index');
        Route::post('project/create','ProjectController@store');
        Route::post('project/update','ProjectController@update');
        Route::post('project/dataupdate','ProjectController@dataUpdate');
    });

    //Route to unauthorized
    Route::get('error','DashboardController@error');

});

