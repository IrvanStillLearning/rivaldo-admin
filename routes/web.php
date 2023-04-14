<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;

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

Route::get('/', function(){
    return Redirect::to('/admin');
});

Route::prefix('admin')->group(function(){
    Route::get('login', [App\Http\Controllers\admin\LoginController::class, 'index']);
    Route::post('login', [App\Http\Controllers\admin\LoginController::class, 'login'])->name('login');
    
    Route::get('register', [App\Http\Controllers\admin\LoginController::class, 'index_register']);
    Route::post('register', [App\Http\Controllers\admin\LoginController::class, 'register']);

    
    Route::group(['middleware' => 'auth'], function(){
        Route::get('/', function(){
            return redirect('admin/dashboard');
        });
        
        Route::get('dashboard', function () {
            return view('admin.index');
        })->name('dashboard');

        Route::prefix('tempat-magang')->group(function(){
            Route::get('/', [App\Http\Controllers\admin\TempatMagangController::class, 'index']);
            Route::get('datatables', [App\Http\Controllers\admin\TempatMagangController::class, 'datatables']);
            Route::get('detail/{id}', [App\Http\Controllers\admin\TempatMagangController::class, 'detail']);
            Route::post('store-update', [App\Http\Controllers\admin\TempatMagangController::class, 'store_update']);
            Route::delete('delete/{id}', [App\Http\Controllers\admin\TempatMagangController::class, 'delete']);
        });

        Route::prefix('siswa')->group(function(){
            Route::get('/', [App\Http\Controllers\admin\SiswaController::class, 'index']);
            Route::get('datatables', [App\Http\Controllers\admin\SiswaController::class, 'datatables']);
            Route::get('detail/{id}', [App\Http\Controllers\admin\SiswaController::class, 'detail']);
            Route::get('cetak-data-diri/{id}', [App\Http\Controllers\admin\SiswaController::class, 'cetak_data_diri']);
            Route::post('store-update', [App\Http\Controllers\admin\SiswaController::class, 'store_update']);
            Route::delete('delete/{id}', [App\Http\Controllers\admin\SiswaController::class, 'delete']);
        });


        Route::post('mode/{id}', [\App\Http\Controllers\admin\ModeController::class, 'index']);
        Route::get('logout', [App\Http\Controllers\admin\LoginController::class, 'logout']);
    });
    
});
