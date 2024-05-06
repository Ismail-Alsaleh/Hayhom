<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateImageRequest;
use App\Models\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class UploadImageController extends Controller
{
    public function uploadImage(Request $request){
        try{
            if($request->hasFile('image')){

                $path = $request->file('image')->store('temp');
                $file = $request->file('image');

                $fileName = Str::random(2) . '_' . time() . '_' . $file->getClientOriginalName();
                $img = Image::make($request->image);
                $img->fit(800,800)->save(public_path('images/800x800/') . $fileName);
                $img->fit(500,500)->save(public_path('images/500x500/') . $fileName);
                $img->fit(200,200)->save(public_path('images/200x200/') . $fileName);
                $img->fit(80,80)->save(public_path('images/thumbnails/') . $fileName);

                // $file->move(public_path('images'), $fileName);
                // return response()->json(['errors' => $fileName]);
                UploadImage::create([
                    'title' => $request->input('title'),
                    'image' => $fileName,
                ]);
                return response()->json(['success'=> __('image_upload.upload_success')]);
            }
            else{
                return response()->json(['errors' => 'Error occurred while adding user']);
            }
        }catch (\Exception $e) {
        // Log the error or handle it appropriatel
            return response()->json(['errors' => $e->getMessage()]);
        }
    }
    public function showImages(){
        $image = UploadImage::get();
        return view('image_gallery',['images' => $image]);
    }
    public function imageDetails($id){
        $image = UploadImage::find($id);
        return view('image_details', ['image' => $image]);
    }
}
