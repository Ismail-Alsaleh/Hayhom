<?php

namespace App\Http\Controllers;

use \Spatie\Tags\Tag;
use App\Http\Requests\CreateImageRequest;
use App\Models\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class UploadImageController extends Controller
{
    public function uploadImage(CreateImageRequest $request){
        try{
            if($request->hasFile('image')){
                // $path = $request->file('image')->store('temp');
                $file = $request->file('image');
                $fileName = Str::random(2) . '_' . time() . '_' . $file->getClientOriginalName();
                $img = Image::make($request->image);
                $img->fit(800,800)->save(public_path('images/800x800/') . $fileName);
                $img->fit(500,500)->save(public_path('images/500x500/') . $fileName);
                $img->fit(200,200)->save(public_path('images/200x200/') . $fileName);
                $img->fit(80,80)->save(public_path('images/thumbnails/') . $fileName);
                
                $tagNames = explode(',', $request->input('tags'));
                $tags = [];
                foreach ($tagNames as $tagName) {
                    $tags[] = Tag::findOrCreate($tagName);
                }
                $image = UploadImage::create([
                    'title' => $request->input('title'),
                    'image' => $fileName,
                ]);
                $image->attachTags($tags);
                Cache::forget('cached_images');
                return response()->json(['success'=> __('image_upload.upload_success')]);
            }
            else{
                return response()->json(['errors' => 'Error occurred while adding user']);
            }
        }catch (\Exception $e) {
            return response()->json(['errors' => $e->getMessage()]);
        }
    }
    public function showImages(){
        $image = UploadImage::with('tags')->orderBy('created_at','desc')->paginate(12);
        return view('image_gallery',['images' => $image]);
    }
    public function imageDetails($id){
        $image = UploadImage::find($id);
        return view('image_details', ['image' => $image]);
    }

    public function sortImages(Request $request){
        $pageNumber = $request->input('pageNumber');
        $sortVar = $request->input('sortVar');
        $sortWay = $request->input('sortWay');
        // $images = UploadImage::with('tags')->orderBy($sortVar,$sortWay)->paginate(10);

        // return view('gallery_container', compact('images'))->render();
        if($request->input('greaterThan')){
            $greaterThan = $request->input('greaterThan');
            $lessThan = $request->input('lessThan');
            $searchValue = $request->input('searchValue');
            $images = UploadImage::with('tags')
            ->where(function($query) use ($searchValue) {
                $query->where('title', 'like', '%'.$searchValue.'%')
                    ->orWhereHas('tags', function($query) use ($searchValue) {
                        $query->where('name', 'like', '%'.$searchValue.'%');
                    });
            })
            ->where('created_at', '>=', $greaterThan)
            ->where('created_at', '<=', $lessThan)
            ->orderBy($sortVar, $sortWay)
            ->paginate(12);
        }else{
            $images = UploadImage::with('tags')->orderBy($sortVar,$sortWay)->forPage($pageNumber, 12)->paginate(12);
        }
        Cache::put('cached_images', $images, now()->addMinutes(60));
        
        return response()->json([
            'images' => $images->items(),
            'pagination' => [
                'current_page' => $images->currentPage(),
                'total' => $images->total(),
                'per_page' => $images->perPage(),
                'last_page' => $images->lastPage(),
                'next_page_url' => $images->nextPageUrl(),
                'prev_page_url' => $images->previousPageUrl(),
            ]
        ]);
        
        // return response()->json(['success' => "Successfully retrieved data", 'images' => $images]);
    }
// // Step 1: Initial Image Caching
// $images = YourModel::all(); // Retrieve all images from the database

// // Serialize and save the images to a file or directory
// file_put_contents(storage_path('app/images_cache'), serialize($images));

// // Step 2: Querying from Cached Images
// // Retrieve cached images from the file or directory
// $cachedImages = unserialize(file_get_contents(storage_path('app/images_cache')));

// // Apply query conditions (e.g., filter, sort) to the cached images
// // For example, you can use Laravel collection methods like filter, sortBy, etc.
// $queryResults = $cachedImages->filter(function ($image) {
//     // Apply your query conditions here
//     return $image->someAttribute === 'someValue';
// });

// // Return the filtered/sorted images as per the query
// return $queryResults;
// }
