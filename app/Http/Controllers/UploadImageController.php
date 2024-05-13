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
    public function cacheImagesDB(){
        $images = $image = UploadImage::with('tags')->get();
        $serializedImages = serialize($images);
        Cache::put('images_cache', $serializedImages,60*60);
    }
    public function cacheSizedImage($size ,$imageName)
    {
        if($size == 80){
            $originalImagePath = public_path("img/thumbnails/" . $imageName);
        }else{
            $originalImagePath = public_path("img/{$size}x{$size}/" . $imageName);
        }
        $cachedImage = Image::cache(function ($image) use ($originalImagePath) {
            return $image->make($originalImagePath)->greyscale();
        }, 60,true);
        return $cachedImage;
    }
    public function uploadImage(CreateImageRequest $request){
        try{
            if($request->hasFile('image')){
                // $path = $request->file('image')->store('temp');
                $file = $request->file('image');
                $fileName = Str::random(2) . '_' . time() . '_' . $file->getClientOriginalName();
                $sizes = [800, 500, 200, 80];
                foreach ($sizes as $size) {
                    $img = Image::make($request->image)->fit($size, $size);
                    if($size == 80){
                        $img->save(public_path("img/thumbnails/") . $fileName);
                        $path = "img/thumbnails/" . $fileName;
                    }else{
                        $img->save(public_path("img/{$size}x{$size}/") . $fileName);
                        $path = "img/{$size}x{$size}/" . $fileName;
                    }   
                    $cachedImage = $this->cacheSizedImage($size,$fileName);

                }
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
                $this->cacheImagesDB();
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
        if (!Cache::has('images_cache')) {
            $this->cacheImagesDB();
        }
        $serializedImages = Cache::get('images_cache');
        $images = unserialize($serializedImages);
        $sortedImages = $images->sortByDesc('created_at');

        return view('image_gallery',['images' => $sortedImages]);
    }

    public function imageDetails($id){
        $image = UploadImage::find($id);
        return view('image_details', ['image' => $image]);
    }

    public function sortImages1(Request $request){
        $pageNumber = $request->input('pageNumber');
        $sortVar = $request->input('sortVar');
        $sortWay = $request->input('sortWay');

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
            ->get();
        }else{
            $images = UploadImage::with('tags')->orderBy($sortVar,$sortWay);
        }
        return response()->json([
            'images' => $images,
        ]);
    }
    public function sortImages(Request $request){
        if (!Cache::has('images_cache')) {
            $this->cacheImagesDB();
        }

        $serializedImages = Cache::get('images_cache');
        $images = unserialize($serializedImages);

        $sortVar = $request->input('sortVar');
        $sortWay = $request->input('sortWay');
        if($sortWay == 'asc'){
            $sortedImages = $images->sortBy($sortVar,  SORT_NATURAL|SORT_FLAG_CASE);
        }else{
            $sortedImages = $images->sortByDesc($sortVar,  SORT_NATURAL|SORT_FLAG_CASE);
        }
        $sortedImagesArray = $sortedImages->values()->all();
        $greaterThan = $request->input('greaterThan');
        $lessThan = $request->input('lessThan');
        $searchValue = $request->input('searchValue');

        $filteredImages = [];
        foreach ($sortedImagesArray as $image) {
            $dateRangeMatch = $image->created_at >= $greaterThan && $image->created_at <= $lessThan;
            if ($searchValue !== null) {
                $titleMatches = strpos($image->title, $searchValue) !== false;
                $tagsMatch = $image->tags->every(function ($tag) use ($searchValue) {
                    return stripos($tag->name, $searchValue) !== false;
                });
                if (($tagsMatch || $titleMatches) && $dateRangeMatch) {
                    $filteredImages[] = $image;
                }
            } elseif ($dateRangeMatch) {
                $filteredImages[] = $image;
            }
        }
        return response()->json([
            'images' => array_values($filteredImages),
        ]);

    }

}