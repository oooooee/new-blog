<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('test', function(){
    Mail::send('emails.password', array('token' => 'ccc'), function($message)
    {
        $message->to('oooooee@qq.com', 'John Smith')->subject('新商品提醒' . date('Y-m-d H:i:s'));
    });
});


/**
 * admin
 */
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function()
{
	Route::get('index','AdminController@index');

	Route::get('articles/index','ArticlesController@index');
	Route::get('articles/trash','ArticlesController@trash');
	Route::post('articles/restore/{id}','ArticlesController@restore');
	Route::delete('articles/forceDelete/{id}','ArticlesController@forceDelete');
	Route::resource('articles','ArticlesController');

	Route::get('categories/index','CategoriesController@index');
	Route::resource('categories','CategoriesController');

	Route::get('tags/index','TagsController@index');
	Route::resource('tags','TagsController');

	Route::get('settings/index','SettingsController@index');
	Route::patch('settings/index','SettingsController@update');

	Route::post('uploadImage', 'ArticlesController@uploadImage');

	Route::get('setting/flush',function(){
		\Cache::flush();
		return 'cache flush ok';
	});
});

/**
 * auth
 */
Route::get('login','Admin\AuthController@getLogin');
Route::post('login','Admin\AuthController@postLogin');
Route::get('logout','Admin\AuthController@logout');


/*Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
*/

Route::get('foo',function(){
	\Cache::flush();
	return 'ok';
});

Route::get('bar',function(){

	return view('aaa');

});

Route::get('sns_get_login', 'Home\HomeController@sns_get_login');
Route::get('sns_login', 'Home\HomeController@sns_login');

/**
 * home
 */
Route::group(['namespace' => 'Home'], function()
{

	Route::resource('/','HomeController@index');
	Route::resource('/about','HomeController@about');

	Route::get('tags', 'TagsController@index');
	Route::get('tags/{slug}', 'TagsController@show');

	Route::get('categories', 'CategoriesController@index');
	Route::get('categories/{slug}', 'CategoriesController@show');

	Route::get('articles', 'ArticlesController@index');
	Route::get('{slug}', 'ArticlesController@show');
//	Route::get('{slug}', 'ArticlesController@show_bak');
});


/**
 * spider
 */
//Route::get('spider/smzdm', 'SpiderController@smzdm');
//Route::get('spider/huihui', 'SpiderController@huihui');
//Route::get('spider/mgpyh', 'SpiderController@mgpyh');
Route::get('spider/index', 'SpiderController@index');
Route::get('coke/dajuhui', 'SpiderController@show');



