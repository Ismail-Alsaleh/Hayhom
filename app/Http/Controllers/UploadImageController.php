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
use Spatie\ResponseCache\Facades\ResponseCache;
use Spatie\ResponseCache\Middlewares\CacheResponse;

class UploadImageController extends Controller
{

    public function uploadImage(CreateImageRequest $request){
        try{
            if($request->hasFile('image')){
                $file = $request->file('image');
                $fileName = Str::random(3) . '_' . time() . '_' . $file->getClientOriginalName();
                    $img = Image::make($request->image);
                    $img->save(public_path("images/images_gallery/") . $fileName);
                $tagNames = explode(',', $request->input('tags'));
                $tags = [];
                foreach ($tagNames as $tagName) {
                    $tags[] = Tag::findOrCreate($tagName);
                }
                $cleanTitle = strip_tags(html_entity_decode($request->title));
                $image = UploadImage::create([
                    'title' => $cleanTitle,
                    'image' => $fileName,
                ]);
                $image->attachTags($tags);
                // $this->cacheImagesDB();
                ResponseCache::forget('/gallery');
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
        $images = UploadImage::with('tags')->get();
        $sortedImages = $images->sortByDesc('created_at');
        return view('image_gallery',['images' => $sortedImages]);
    }

    public function imageDetails($id){
        $image = UploadImage::find($id);
        return view('image_details', ['image' => $image]);


    }
    public function sortImages(Request $request){

        $sortVar = $request->input('sortVar');
        $sortWay = $request->input('sortWay');
        $greaterThan = $request->input('greaterThan');
        $lessThan = $request->input('lessThan');
        $searchValue = $request->input('searchValue');
        if($searchValue == null){
            $searchValue = '';
        }
        $images = UploadImage::with('tags')
        ->where(function($query) use ($searchValue) {
            $query->where('title', 'like', '%'.$searchValue.'%')
                ->orWhereHas('tags', function($query) use ($searchValue) {
                    $query->where('name', 'like', '%'.$searchValue.'%');
                });
        })
        ->where('created_at', '>=', $greaterThan)
        ->where('created_at', '<=', $lessThan)
        ->orderBy($sortVar, $sortWay)->get();
        return response()->json([
            'images' => $images
        ]);

        // return response()->json(['success' => "Successfully retrieved data", 'images' => $images]);
    }
    // public function sortImages(Request $request){
    //     if (!Cache::has('images_cache')) {
    //         $this->cacheImagesDB();
    //     }

    //     $serializedImages = Cache::get('images_cache');
    //     $images = unserialize($serializedImages);

    //     $sortVar = $request->input('sortVar');
    //     $sortWay = $request->input('sortWay');
    //     if($sortWay == 'asc'){
    //         $sortedImages = $images->sortBy($sortVar,  SORT_NATURAL|SORT_FLAG_CASE);
    //     }else{
    //         $sortedImages = $images->sortByDesc($sortVar,  SORT_NATURAL|SORT_FLAG_CASE);
    //     }
    //     $sortedImagesArray = $sortedImages->values()->all();
    //     $greaterThan = $request->input('greaterThan');
    //     $lessThan = $request->input('lessThan');
    //     $searchValue = $request->input('searchValue');

    //     $filteredImages = [];
    //     foreach ($sortedImagesArray as $image) {
    //         $dateRangeMatch = $image->created_at >= $greaterThan && $image->created_at <= $lessThan;
    //         if ($searchValue !== null) {
    //             $titleMatches = stripos($image->title, $searchValue) !== false;
    //             $tagsMatch = $image->tags->contains(function ($tag) use ($searchValue) {
    //                 return stripos($tag->name, $searchValue) !== false;
    //             });
    //             if (($tagsMatch || $titleMatches) && $dateRangeMatch) {
    //                 $filteredImages[] = $image;
    //             }
    //         } elseif ($dateRangeMatch) {
    //             $filteredImages[] = $image;
    //         }
    //     }
    //     return response()->json([
    //         'images' => array_values($filteredImages),
    //     ]);

    // }

}