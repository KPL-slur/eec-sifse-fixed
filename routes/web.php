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
        Route::get('/create/image/{id}', [App\Http\Controllers\PmReportController::class, 'reportImage'])->name('report.image');
        Route::post('/create', [App\Http\Controllers\PmReportController::class, 'store'])->name('store');
        Route::get('/{id}', [App\Http\Controllers\PmReportController::class, 'show'])->name('show');
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

    //distribusi
    Route::get('distribution', [App\Http\Controllers\DistributionController::class, 'index'])->name('distribution');
    Route::get('editDistribution/{id}', [App\Http\Controllers\DistributionController::class, 'edit']);
    Route::post('edit', [App\Http\Controllers\DistributionController::class, 'editData']);
    Route::delete('deleteDistribution/{id}', [App\Http\Controllers\DistributionController::class, 'deleteData']);
    Route::get('addDistribution', [App\Http\Controllers\DistributionController::class, 'add']);
    Route::post('add', [App\Http\Controllers\DistributionController::class, 'addData']);

    //site
    Route::get('site', [App\Http\Controllers\SiteController::class, 'index'])->name('site');
    Route::get('addSite', [App\Http\Controllers\SiteController::class, 'add']);
    Route::post('add', [App\Http\Controllers\SiteController::class, 'addData']);
    Route::get('inventorie/{id}', [App\Http\Controllers\SiteController::class, 'show']);
    Route::get('inventorySite/{id}', [App\Http\Controllers\SiteController::class, 'print']);

    //logActivity
    Route::get('table-list', function () {
        return view('activity.table_list');
    })->name('table');
    
    //stock with currencies
    Route::get('stock_currency', [App\Http\Controllers\StockController::class, 'index'])->name('stock_currency');
    Route::get('stock_currency/{stock}/edit', [App\Http\Controllers\StockController::class, 'edit']);
    Route::get('stock_currency/create', [App\Http\Controllers\StockController::class, 'create'])->name('stock_currency_create');
    Route::post('stock_currency', [App\Http\Controllers\StockController::class, 'store']);
    Route::put('stock_currency/{stock}/update', [App\Http\Controllers\StockController::class, 'update']);
});
