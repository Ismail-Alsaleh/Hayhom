<?php

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\UploadImageController;
use App\Http\Middleware\Localization;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;







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
// route::get('/caching/{template}/{fileName}', function($tamplate, $fileName){
//     $cachedImage = Image::cache(function ($image) use ($tamplate ,$fileName){
//         // $fullPath = public_path('images/6l2KIf.jpg');
//         $fullPath = public_path('images/'. $fileName);
//         // dd($fullPath);
//         return $image->make($fullPath)->greyscale();
//     }, 60, true);

//     // $cachedImage->save('helloWorld.jpg');
//     return $cachedImage->response();
//     // return($cachedImage->save('helloWorld.jpg'));
// })->name('imageCache');

Route::get('/caching/{template}/{fileName}', function($template, $fileName) {
    // Check if the template exists in the configuration
    $templates = [
        'thumbnails' => ['width' => 80, 'height' => 80],
        '200x200' => ['width' => 200, 'height' => 200],
        '500x500' => ['width' => 500, 'height' => 500],
        '800x800' => ['width' => 800, 'height' => 800],
    ];

    if (!isset($templates[$template])) {
        abort(404); // Template not found
    }

    // Manipulate and cache the image using Intervention/ImageCache
    $imagePath = public_path('images/' . $fileName); // Assuming images are stored in the public/images directory
    if (!file_exists($imagePath)) {
        abort(404); // Image file not found
    }

    // Create an instance of Intervention/ImageCache
    $imageCache = Image::cache(function($image) use ($imagePath,$templates, $template) {
        // Apply the specified template to the image
        $templateDimensions = $templates[$template];
        return $image->make($imagePath)->fit($templateDimensions['width'], $templateDimensions['height']);
    }, config('imagecache.lifetime'),true);

    // Return the manipulated and cached image as a response
    return $imageCache->response();
})->name('imageCache');