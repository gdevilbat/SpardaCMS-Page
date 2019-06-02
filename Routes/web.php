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

Route::group(['prefix' => 'control', 'middleware' => 'core.menu'], function() {
    
	Route::group(['middleware' => 'core.auth'], function() {

		Route::group(['prefix' => 'page'], function() {
	        /*=============================================
	        =            Post CMS            =
	        =============================================*/
	        
			    Route::get('master', 'PageController@index')->middleware('can:menu-page')->name('page');
			    Route::get('form', 'PageController@create')->name('page');
			    Route::post('form', 'PageController@store')->middleware('can:create-page')->name('page');
			    Route::put('form', 'PageController@store')->name('page');
			    Route::delete('form', 'PageController@destroy')->name('page');

			    Route::group(['prefix' => 'api'], function() {
				    Route::get('master', 'PageController@serviceMaster')->middleware('can:menu-page');
			    });
	        
	        /*=====  End of Post CMS  ======*/
		});

        
	});
});