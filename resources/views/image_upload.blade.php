@extends('layouts.layout')
@section('title','Image_Upload')
@section('content')
        <div class="container-floid d-flex align-items-center justify-content-center m-0" style="height: 83vh;">
            <div id="imagePart" class="w-50 text-center shadow align-items-center" style="">
                <div class="bg-light-red pt-3 m-0"></div>
                <div class="mb-2">
                    <h1 class="mb-0 mt-0 display-6 mt-4" >{{ __('image_upload.upload_image') }}</h1>
                    <hr class="text-white">
                </div>
                <form method="POST"  enctype="multipart/form-data" action="{{route('uploadImage')}}" class="mb-4 text-start mx-5" id="imageForm">
                    @csrf
                    <div class="mb-2">
                        <div class="">
                            <label for="title">{{__('messages.title')}}</label>
                            <input type="text" class="text-center py-2 w-100 border-0" name="title" id="title" placeholder="{{__('messages.insert')}} {{__('messages.title')}}">
                        </div>
                        <div class="">
                            <label for="image">{{ __('messages.image') }}</label>
                        </div>
                        <div class="">
                            <input type="file" class="filepond"  id="image" name="image" required accept="image/png , image/jpeg">                            
                        </div>

                    </div>
                    <div class="">
                        <p class="imageErr text-danger"></p>
                        <p class="imageCountry text-success"></p>                        
                    </div>

                    <!-- <h5 id="phoneValidate" style="color: red;"> **phone is not correct </h5>  -->
                    <button id="submitButton" class="w-100 border-0 bg-light-red fs-3 p-2 mt-4 text-white">{{ __('messages.upload') }}</button>
                </form>
                <p class="d-none" id="lang">{{app()->getlocale()}}</p>


                <script>

                </script>
            </div>
        </div>
@endsection

@push('js_file')
    <script src="{{ asset('js/filepond/filepond.js') }}"></script>
    <script src="{{ asset('js/filepond/filepond-plugin-file-validate-type.js')}}"></script>
    <script src="{{ asset('js/filepond/filepond-plugin-file-validate-size.js')}}"></script>
    <script src="{{asset('js/image_upload.js')}}"></script>
@endpush