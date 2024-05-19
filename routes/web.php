<?php

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\UploadImageController;
use App\Http\Middleware\Localization;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManagerStatic;
use Spatie\ResponseCache\Middlewares\CacheResponse;










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
})->middleware(CacheResponse::class);
Route::post('/image',[UploadImageController::class, 'uploadImage'])->name('uploadImage')->middleware(CacheResponse::class);
Route::post('/gallery',[UploadImageController::class, 'sortImages'])->name('sort')->middleware(CacheResponse::class);
Route::get('/gallery', [UploadImageController::class, 'showImages'])->name('showImages')->middleware(CacheResponse::class);
Route::get('/gallery/{id}', [UploadImageController::class, 'imageDetails'])->name('image-details')->middleware(CacheResponse::class);

Route::middleware([Localization::class])->group(function () {
    Route::get('/language/{locale}', [LanguageController::class, 'switchLocale'])->name('lang.switch');
});
route::get('/test', function(){
    return view('test');
});

Route::get('/caching/{template}/{filename}', '\Intervention\Image\ImageCacheController@getResponse')->where('filename', '(.*)')->name('imageCache');


