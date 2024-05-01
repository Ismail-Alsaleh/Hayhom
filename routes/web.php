<?php

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PhoneController;



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
// Route::get('/{locale}', [LanguageController::class, 'switchLocale'])->name('lang.switch');
// Route::get('/{locale}',function($locale){
//     App::setLocale($locale);
//     return redirect()->route('home','ar');
// })->name('lang.switch');
Route::get('/{locale}', [PhoneController::class, 'index'])->name('lang.switch');
Route::post('/',[PhoneController::class, 'store'])->name('store');
Route::get('/',function(){
    return view('phone_form');
})->name('home');


