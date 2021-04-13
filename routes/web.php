<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;

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

Route::get('/', function () {
    return redirect()->route('login');
});

/* Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard'); */

Route::group(['middleware' => 'auth'], function(){
    /* Dashboard Action */
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    /* Products Action */
    Route::resource('products', ProductController::class);

    /* Suppliers Action */
    Route::resource('suppliers', SupplierController::class);

    /* Transaction Action */
    Route::group(['prefix'=>'transactions'], function(){
        Route::get('/', [TransactionController::class, 'index'])->name('transactions.index');
        Route::post('/store', [TransactionController::class, 'store'])->name('transactions.store');
    });

    /* Cart Action */
    Route::group(['prefix'=>'carts'], function(){
        Route::get('/', [CartController::class, 'index'])->name('carts.index');
        Route::post('/store', [CartController::class, 'store'])->name('carts.store');
        Route::put('/update', [CartController::class, 'update'])->name('carts.update');
        Route::delete('/destroy/{cart}', [CartController::class, 'destroy'])->name('carts.destroy');
    });

    /* Report Action */
    Route::group(['prefix'=>'reports'], function(){
        /* daily report */
        Route::get('/daily', [ReportController::class, 'dailyIndex'])->name('dailyReport.index');
        /* monthly report */
        Route::group(['middleware'=>'RoleAdmin'], function(){
            Route::get('/monthly', [ReportController::class, 'monthlyIndex'])->name('monthlyReport.index');
            Route::get('/monthly/{filter}', [ReportController::class, 'monthlyFilter'])->name('monthlyReport.filter');
        });
    });
});
