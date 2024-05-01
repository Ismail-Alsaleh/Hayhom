<?php

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PhoneController;
use App\Http\Middleware\Localization;




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

Route::get('/', [PhoneController::class, 'index'])->name('name');
Route::post('/',[PhoneController::class, 'store'])->name('store');
Route::middleware([Localization::class])->group(function () {
    Route::get('/language/{locale}', [LanguageController::class, 'switchLocale'])->name('lang.switch');
});

