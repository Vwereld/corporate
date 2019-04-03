<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::resource('/','IndexController',[
    'only' => ['index'],
    'names' => ['index'=>'home']
]);

Route::resource('portfolios' , 'PortfolioController',
    [
       'parameters' => [
           'portfolios' => 'alias'
       ]
    ]);

Route::resource('articles', 'ArticlesController', [
    'parameters' => [
        'articles' => 'alias'
    ]
]);

Route::get('articles/cat/{cat_alias?}',['uses'=>'ArticlesController@index','as'=>'articlesCat'])->where('cat_alias','[\w-]+');

Route::resource('comment','CommentController',['only'=>['store']]);

Route::match(['get','post'],'/contacts',['uses' =>'ContactsController@index', 'as' => 'contacts']);

Route::get('login',['as' => 'login', 'uses' =>'Auth\LoginController@showLoginForm']);


Route::post('login',['as' => 'login', 'uses' =>'Auth\LoginController@login']);

Route::get('logout',['as' => 'logout','uses'=>'Auth\LoginController@logout']);

Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){
    Route::get('/',['uses'=>'Admin\IndexController@index'])->name('admin.articles.index');
//    Route::get('/{articles}/edit', 'Admin\ArticlesController@edit')->name('admin.articles.update');
//    Route::match(['post','put','patch'],'/{articles}/edit', 'Admin\ArticlesController@update')->name('admin.articles.update');
//    Route::get('admin.articles.create', 'Admin\ArticlesController@create')->name('admin.articles.create');
//    Route::delete('{alias}/edit', 'Admin\ArticlesController@destroy')->name('destroy');
//    Route::post('admin.article.store', 'Admin\ArticlesController@store')->name('store');
//    Route::resource('/articles/','Admin\ArticlesController');
    Route::resource('/articles/', 'Admin\ArticlesController', [
        'parameters' => ['' => 'articles']]);
    Route::resource('/permissions','Admin\PermissionsController');
    Route::resource('/menus','Admin\MenusController');
    Route::resource('/users','Admin\UsersController');
});


//Route::get('/home', 'HomeController@index')->name('home');
