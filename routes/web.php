<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Auth::routes();

Route::get('/tech', [App\Http\Controllers\TechController::class, 'index'])->name('tech');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('is_admin');

Route::group(['middleware' => 'auth'], function () {
	Route::get('table-list', function () {
		return view('pages.table_list');
	})->name('table');

	Route::get('stock-currency', [App\Http\Controllers\StockAndCurrencyController::class, 'index'])->name('stock-currency');

	Route::get('site', function () {
		return view('pages.site');
	})->name('site');

	Route::get('stock-maintanance', function () {
		return view('pages.stock-maintanance');
	})->name('stock-maintanance');

	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
});

//distribusi
Route::get('distribution', [App\Http\Controllers\DistributionController::class, 'index'])->name('distribution');
Route::get('editDistribution/{id}', [App\Http\Controllers\DistributionController::class, 'edit']);
Route::post('edit', [App\Http\Controllers\DistributionController::class, 'editData']);
Route::delete('deleteDistribution/{id}', [App\Http\Controllers\DistributionController::class, 'deleteData']);
Route::get('addDistribution', [App\Http\Controllers\DistributionController::class, 'add']);
Route::post('add', [App\Http\Controllers\DistributionController::class, 'addData']);

//inventorie
Route::get('inventorie', function(){
	return view('site.inventorie');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});
