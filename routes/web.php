<?php

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\UploadImageController;
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
Route::get('/image', function(){
    return view('image_upload');
});
Route::post('/image',[UploadImageController::class, 'uploadImage'])->name('uploadImage');
Route::post('/gallery',[UploadImageController::class, 'sortImages'])->name('sort');
Route::get('/gallery', [UploadImageController::class, 'showImages'])->name('showImages');
Route::get('/gallery/{id}', [UploadImageController::class, 'imageDetails'])->name('image-details');

Route::middleware([Localization::class])->group(function () {
    Route::get('/language/{locale}', [LanguageController::class, 'switchLocale'])->name('lang.switch');
});
route::get('/test', function(){
    return view('test');
});

