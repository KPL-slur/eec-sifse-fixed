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

/*
|--------------------------------------------------------------------------
| USER/expert/AUTH ROUTES
|--------------------------------------------------------------------------
|
| Semua routes yang hanya bisa di akses oleh user
| atau expert atau siapapun yang memiliki akun
| tolong ditaro disini, karena pada route
| ini digunakan middleware auth
|
*/
Route::group(['middleware' => 'auth', 'prefix' => 'expert'], function () {
    Route::get('/', [App\Http\Controllers\ExpertController::class, 'index'])->name('expert');
    
    // PM REPORT ROUTES
    Route::group(['prefix' => 'pm', 'as' => 'pm.'], function () {
        Route::get('/', [App\Http\Controllers\PmReportController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\PmReportController::class, 'create'])->name('create');
        Route::post('/', [App\Http\Controllers\PmReportController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [App\Http\Controllers\PmReportController::class, 'edit'])->name('edit');
        Route::put('/{id}', [App\Http\Controllers\PmReportController::class, 'update'])->name('update');
        Route::get('/{id}', [App\Http\Controllers\PmReportController::class, 'show'])->name('show');
        Route::delete('/{id}', [App\Http\Controllers\PmReportController::class, 'destroy'])->name('delete');
    });

    // Route::get('report/pm/create/{headId}', ['App\Http\Controllers\PmBodyReportsController', 'create'])->name('pm.custom.create'); //custom create routing
    // Route::get('report/pm/{pmBodyReport}/{headId}/edit', ['App\Http\Controllers\PmBodyReportsController', 'edit'])->name('pm.custom.edit'); //custom create routing
    // Route::resource('report/pm', 'App\Http\Controllers\PmBodyReportsController', ['except' => ['create', 'edit'], 'parameters' => ['pm' => 'pmBodyReport:head_id',]]);
    
    // PM REPORT ROUTES
    // Route::get('report/cm/create/{headId}', ['App\Http\Controllers\CmBodyReportsController', 'create'])->name('cm.custom.create'); //custom create routing
    // Route::get('report/cm/{cmBodyReport}/{headId}/edit', ['App\Http\Controllers\CmBodyReportsController', 'edit'])->name('cm.custom.edit'); //custom create routing
    // Route::resource('report/cm', 'App\Http\Controllers\CmBodyReportsController', ['except' => ['create', 'edit'], 'parameters' => ['cm' => 'cmBodyReport:head_id',]]);
    
    // recommendations ROUTES
    // Route::get('report/recommendations/create/{headId}', ['App\Http\Controllers\RecommendationsController', 'create'])->name('recommendations.custom.create'); //custom create routing
    // Route::get('report/recommendations/{headId}/edit', ['App\Http\Controllers\RecommendationsController', 'edit'])->name('recommendations.custom.edit'); //custom edit routing
    // Route::get('report/recommendations/{headId}', ['App\Http\Controllers\RecommendationsController', 'show'])->name('recommendations.custom.show'); //custom show routing
    // Route::put('report/recommendations/{headId}', ['App\Http\Controllers\RecommendationsController', 'update'])->name('recommendations.custom.update'); //custom update routing
    // Route::post('report/recommendations', ['App\Http\Controllers\RecommendationsController', 'store'])->name('recommendations.custom.store'); //custom store routing

    // REPORT ROUTES
    // Route::resource('report', 'App\Http\Controllers\HeadReportsController', ['parameters' => ['report' => 'headReport',]]);
    
    //Bawaan dari template
    Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
|
| Semua routes yang hanya bisa di akses oleh admin
| tolong ditaro disini, karena pada route ini
| digunakan middleware IsAdmin
|
*/

Route::middleware(['auth', 'is_admin'])->group(function () {
    //Halaman Pertama Admin
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //Halaman Statis Admin
    //Nanti jgn lupa dihapus semua ini

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

    //user_management
    Route::get('userManagement', [App\Http\Controllers\UserController::class, 'index'])->name('userManagement');
    Route::post('addUser', [App\Http\Controllers\UserController::class, 'addData']);
    Route::get('editUser/{id}', [App\Http\Controllers\UserController::class, 'index']);
    Route::post('editUser', [App\Http\Controllers\UserController::class, 'editData']);
    Route::delete('deleteUser/{id}', [App\Http\Controllers\UserController::class, 'deleteData']);

    //distribusi
    Route::get('distribution', [App\Http\Controllers\DistributionController::class, 'index'])->name('distribution');
    Route::get('viewDistribution/{id}', [App\Http\Controllers\DistributionController::class, 'show']);
    Route::get('editDistribution/{id}', [App\Http\Controllers\DistributionController::class, 'edit']);
    Route::post('edit', [App\Http\Controllers\DistributionController::class, 'editData']);
    Route::delete('deleteDistribution/{id}', [App\Http\Controllers\DistributionController::class, 'deleteData']);
    Route::get('addDistribution/{id}', [App\Http\Controllers\DistributionController::class, 'add']);
    Route::post('addDst', [App\Http\Controllers\DistributionController::class, 'addData']);

    //site
    Route::get('site', [App\Http\Controllers\SiteController::class, 'index'])->name('site');
    Route::get('addSite', [App\Http\Controllers\SiteController::class, 'add']);
    Route::post('add', [App\Http\Controllers\SiteController::class, 'addData']);
    //inventory site
    Route::get('inventory/{id}', [App\Http\Controllers\SiteController::class, 'show']);
    Route::get('addInventorySite/{id}', [App\Http\Controllers\SiteController::class, 'addInventorySite']);
    Route::post('addInventorySite', [App\Http\Controllers\SiteController::class, 'addDataInventorySite']);
    Route::get('inventorySite/{id}', [App\Http\Controllers\SiteController::class, 'print']);
    Route::get('editInventorySite/{sitedstock}', [App\Http\Controllers\SiteController::class, 'editInventorySite']);
    Route::put('editInventorySite/{stock}', [App\Http\Controllers\SiteController::class, 'editDataInventorySite']);
    Route::delete('deleteInventorySite/{sitedstock}', [App\Http\Controllers\SiteController::class, 'destroyInventorySite']);

    //expertActivity
    Route::get('expertActivity', [App\Http\Controllers\ExpertActivityController::class, 'index'])->name('expertActivity'); 
    Route::get('pm', [App\Http\Controllers\ExpertActivityController::class, 'indexPM']); 
    Route::get('addPm', [App\Http\Controllers\ExpertActivityController::class, 'add']); 
    Route::post('addPM', [App\Http\Controllers\ExpertActivityController::class, 'addData']); 
    Route::delete('deletePm/{id}', [App\Http\Controllers\ExpertActivityController::class, 'deleteData']);
    Route::get('editPm/{id}', [App\Http\Controllers\ExpertActivityController::class, 'editPm']);
    Route::post('editPM', [App\Http\Controllers\ExpertActivityController::class, 'editDataPm']);

    Route::get('cm', [App\Http\Controllers\ExpertActivityController::class, 'indexCM']); 
    
    //stock with currencies
    Route::get('stock_currency', [App\Http\Controllers\StockController::class, 'index'])->name('stock_currency'); // index stocks
    Route::get('stock_currency/{stock}/edit', [App\Http\Controllers\StockController::class, 'edit']); //edit specific stock
    Route::post('stock_currency/', [App\Http\Controllers\StockController::class, 'store']); // save new sparepart
    Route::get('stock_currency/create', [App\Http\Controllers\StockController::class, 'create'])->name('stock_currency_create'); // input new spare part
    Route::put('stock_currency/{stock}/update', [App\Http\Controllers\StockController::class, 'update']); // save the edited stock
    Route::delete('stock_currency/{stock}', [App\Http\Controllers\StockController::class, 'destroy']); // delete specific spare part
    Route::get('stock_currency/{date_start}/{date_end}/', [App\Http\Controllers\StockController::class, 'report']);
    Route::get('recommendation', [App\Http\Controllers\StockController::class, 'showRecommendation'])->name('recommendation'); //recommendation item
    Route::get('stock_currency/send-email', [App\Http\Controllers\StockController::class, 'sendEmail']);
});
