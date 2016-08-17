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

Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::group(array('domain' => 'ad.udon'), function()
    {
        Route::get('/', 'MainController@index');
        Route::get('/index', 'MainController@index');
        Route::get('/main', 'MainController@index');
        Route::get('/logout', 'AuthController@logout');

        Route::get('/user/get', [
            'as' => 'get', 'uses' => 'UserController@get'
        ]);
        Route::resource('/user','UserController');

        Route::get('/role/get', ['as' => 'get', 'uses' => 'RoleController@get']);
        Route::resource('/role','RoleController');

        Route::get('/country/get', ['as' => 'get', 'uses' => 'CountryController@get']);
        Route::resource('/country','CountryController');

        Route::get('/city/get', ['as' => 'get', 'uses' => 'CityController@get']);
        Route::resource('/city','CityController');

        Route::get('/region/get', ['as' => 'get', 'uses' => 'RegionController@get']);
        Route::resource('/region','RegionController');

        Route::get('/management/get', ['as' => 'get', 'uses' => 'ManagementController@get']);
        Route::resource('/management','ManagementController');

        Route::get('/menu/get', ['as' => 'get', 'uses' => 'MenuController@get']);
        Route::resource('/menu','MenuController');

        Route::get('/category/get', ['as' => 'get', 'uses' => 'CategoryController@get']);
        Route::resource('/category','CategoryController');

        Route::get('/food/get', ['as' => 'get', 'uses' => 'FoodController@get']);
        Route::resource('/food','FoodController');

        Route::get('/ingredient/get', ['as' => 'get', 'uses' => 'IngredientController@get']);
        Route::resource('/ingredient','IngredientController');//içerik patlıcan domates

        Route::get('/content/get', ['as' => 'get', 'uses' => 'ContentController@get']);
        Route::resource('/content','ContentController');//domuz at eşek

        Route::get('/file/getIngredient/{id}', ['as' => 'get', 'uses' => 'FileController@getIngredientsFiles']);
        Route::get('/file/getContent/{id}', ['as' => 'get', 'uses' => 'FileController@getContentsFiles']);
        Route::get('/file/getManagement/{id}', ['as' => 'get', 'uses' => 'FileController@getManagementsFiles']);
        Route::get('/file/getFood/{id}', ['as' => 'get', 'uses' => 'FileController@getFoodsFiles']);
        Route::resource('/file','FileController');
    });
    Route::group(array('domain' => 'udon'), function()
    {
        Route::get('/', function(){
            return "customer subdomain is not ready yet.";
        });

    });

});
