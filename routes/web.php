<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;

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

Route::group(['prefix' => 'email', 'middleware' =>['auth', 'not_belong'] ], function () {
    Route::get('/verify', function () {
        return view('auth.verify');
    })->name('verification.notice');

    Route::get('/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect(RouteServiceProvider::HOME);
    })->middleware(['signed'])->name('verification.verify');

    Route::post('/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'A fresh verification link has been sent to your email address.');
    })->middleware(['throttle:6,1'])->name('verification.send');
});

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
Route::middleware(['auth', 'verified', 'not_belong'])->group(function (){
    Route::get('waiting-room', function () {
        return view('pages.waiting-room');
    })->name('waiting_room');
});

Route::group(['prefix' => 'expert', 'middleware' =>['auth', 'verified', 'is_approved'] ], function () {
    Route::get('/', [App\Http\Controllers\ExpertController::class, 'index'])->name('expert');

    //STOCKS READ ONLY
    Route::get('/stocks', [App\Http\Controllers\ExpertController::class, 'stocks'])->name('expert_stocks');

    //PROFILE MANAGEMENT
    Route::group(['prefix' => 'profile', 'as' => 'expert.profile.'], function () {
        Route::get('/', [App\Http\Controllers\ProfileController::class, 'edit'])->name('edit');
        Route::put('/', [App\Http\Controllers\ProfileController::class, 'update'])->name('update');
        Route::put('/password', [App\Http\Controllers\ProfileController::class, 'password'])->name('password');
    });

    Route::group(['prefix' => '{maintenance_type}', 'where' => ['maintenance_type' => '(pm|cm)'], 'as'=>'report.'], function () {
        Route::group(['prefix' => 'trash', 'as' => 'trash.'], function () {
            Route::get('/', [App\Http\Controllers\TrashController::class, 'index'])->name('index');
            Route::get('/{id}', [App\Http\Controllers\TrashController::class, 'show'])->name('show');
            Route::post('/{id}', [App\Http\Controllers\TrashController::class, 'restore'])->name('restore');
            Route::delete('/{id}', [App\Http\Controllers\TrashController::class, 'permDelete'])->name('perm_delete');
        });
        Route::group(['prefix' => 'pdf', 'as' => 'pdf.'], function () {
            Route::get('/{id_report}/{path}/view', [App\Http\Controllers\PdfController::class, 'show'])->name('show');
            Route::get('/{id_report}/{path}/download', [App\Http\Controllers\PdfController::class, 'download'])->name('download');
            Route::get('/{id_report}', [App\Http\Controllers\PdfController::class, 'print'])->name('print');
            Route::post('/{id_report}', [App\Http\Controllers\PdfController::class, 'store'])->name('store');
            Route::delete('/{id_report}', [App\Http\Controllers\PdfController::class, 'destroy'])->name('delete');
        });
        Route::get('/', [App\Http\Controllers\ReportController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\ReportController::class, 'create'])->name('create');
        Route::get('/{id_report}/edit', [App\Http\Controllers\ReportController::class, 'edit'])->name('edit');
        Route::get('/{id_report}', [App\Http\Controllers\ReportController::class, 'show'])->name('show');
        Route::delete('/{id_report}', [App\Http\Controllers\ReportController::class, 'destroy'])->name('delete');
    });
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

Route::middleware(['auth', 'verified', 'is_admin'])->group(function () {
    //Halaman Pertama Admin
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //USER MANAGEMENT
    Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);

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

    //Admin profile
    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function (){
        Route::get('/', [App\Http\Controllers\AdminProfileController::class, 'edit'])->name('edit');
        Route::put('/', [App\Http\Controllers\AdminProfileController::class, 'update'])->name('update');
        Route::put('/password', [App\Http\Controllers\AdminProfileController::class, 'password'])->name('password');
    });

    //user management
    Route::get('userManagement', [App\Http\Controllers\UserController::class, 'index'])->name('userManagement');
    Route::post('addUser', [App\Http\Controllers\UserController::class, 'addData']);
    Route::get('editUser/{id}', [App\Http\Controllers\UserController::class, 'index']);
    Route::post('editUser', [App\Http\Controllers\UserController::class, 'editData']);
    Route::delete('deleteUser/{id}', [App\Http\Controllers\UserController::class, 'deleteData']);
    Route::post('approveUser/{id}', [App\Http\Controllers\UserController::class, 'validator']);

    //expert management
    Route::get('expertManagement', [App\Http\Controllers\ExpertiserController::class, 'index'])->name('expertManagement');
    Route::get('addExpert', [App\Http\Controllers\ExpertiserController::class, 'add']);
    Route::post('addExp', [App\Http\Controllers\ExpertiserController::class, 'store']);
    Route::get('editExpert/{expert}', [App\Http\Controllers\ExpertiserController::class, 'edit']);
    Route::put('editExp/{expert}', [App\Http\Controllers\ExpertiserController::class, 'update']);
    Route::delete('deleteExp/{expert}', [App\Http\Controllers\ExpertiserController::class, 'destroy']);

    //distribution
    Route::get('distribution', [App\Http\Controllers\DistributionController::class, 'index'])->name('distribution');
    Route::get('viewDistribution/{dist_id}', [App\Http\Controllers\DistributionController::class, 'show']);
    Route::get('editDistribution/{dist_id}', [App\Http\Controllers\DistributionController::class, 'edit']);
    Route::put('edit/{distribution}', [App\Http\Controllers\DistributionController::class, 'editData']);
    Route::delete('deleteDistribution/{dist_id}', [App\Http\Controllers\DistributionController::class, 'deleteData']);
    Route::get('addDistribution/{dist_id}', [App\Http\Controllers\DistributionController::class, 'add']);
    Route::post('addDst', [App\Http\Controllers\DistributionController::class, 'addData']);

    //site
    Route::get('site', [App\Http\Controllers\SiteController::class, 'index'])->name('site');
    Route::post('add', [App\Http\Controllers\SiteController::class, 'addData']);
    Route::get('addSite', [App\Http\Controllers\SiteController::class, 'add']);
    Route::delete('deleteSite/{id_site}', [App\Http\Controllers\SiteController::class, 'destroySite']);
    //inventory site
    Route::get('inventory/{id_site}', [App\Http\Controllers\SiteController::class, 'show']);
    Route::get('addInventorySite/{id_site}', [App\Http\Controllers\SiteController::class, 'addInventorySite']);
    Route::post('addInventorySite', [App\Http\Controllers\SiteController::class, 'addDataInventorySite']);
    Route::get('inventorySite/{id_site}', [App\Http\Controllers\SiteController::class, 'print']);
    Route::get('editInventorySite/{sitedstock}', [App\Http\Controllers\SiteController::class, 'editInventorySite']);
    Route::put('editInventorySite/{stock}', [App\Http\Controllers\SiteController::class, 'editDataInventorySite']);
    Route::delete('deleteInventorySite/{sitedstock}', [App\Http\Controllers\SiteController::class, 'destroyInventorySite']);

    //expertActivity
    Route::get('expertActivity', [App\Http\Controllers\ExpertActivityController::class, 'index'])->name('expertActivity');
    Route::group(['prefix' => '{maintenance_type}', 'where' => ['maintenance_type' => '(pm|cm)'], 'as' => 'activity.'], function () {
        Route::get('/', [App\Http\Controllers\ExpertActivityController::class, 'indexActivity'])->name('index');
        Route::get('/{id}', [App\Http\Controllers\ExpertActivityController::class, 'show'])->name('show');
    });

    //stock with currencies
    Route::get('stocks', [App\Http\Controllers\StockController::class, 'index'])->name('stocks'); // index stocks
    Route::get('stocks/create', [App\Http\Controllers\StockController::class, 'create'])->name('stocks-create'); // input new spare part
    Route::get('stocks/{stock}/edit', [App\Http\Controllers\StockController::class, 'edit']); //edit specific stock
    Route::post('stocks/', [App\Http\Controllers\StockController::class, 'store']); // save new sparepart
    Route::put('stocks/{stock}/update', [App\Http\Controllers\StockController::class, 'update']); // save the edited stock
    Route::delete('stocks/{stock}', [App\Http\Controllers\StockController::class, 'destroy']); // delete specific spare part
    Route::get('stocks/print', [App\Http\Controllers\StockController::class, 'report']);
    Route::get('stocks/send-email', [App\Http\Controllers\StockController::class, 'sendEmail']);
    Route::get('stocks/recommendation', [App\Http\Controllers\StockController::class, 'showRecommendation'])->name('recommendation'); //recommendation item
});
