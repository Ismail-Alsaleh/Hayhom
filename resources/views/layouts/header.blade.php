<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="{{app()->islocale('ar')? 'rtl':'ltr'}}">
    <head>
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/fontawesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/public.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
        <link rel="stylesheet" href="{{ asset('css/intlTelInput.css') }}">
        <link href="{{asset('css/filepond.css')}}" rel="stylesheet">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <style>
            .error{
                color: red !important;
            }
            label.error{
                width: 100%;
            }
        </style>
        <title>@yield("title")</title>
    </head>
    <body>
        <!-- Navigation Menu -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark-red">
            <div class="container-fluid">
                <a class="navbar-brand fs-2" href="#"><img src="{{asset('images/hayhomWhite.png')}}" alt="Hayhom" style="width: 30px; height: 47px;"></a>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav {{ app()->islocale('en')? 'mr-auto':'ml-auto' }} fs-3">
                        <li class="nav-item  px-4"><a class="nav-link text-white" href="#">{{ __('messages.home') }}</a></li>
                        <li class="nav-item px-4"><a class="nav-link text-white" href="#">{{ __('messages.contact') }}</a></li>
                        <li class="nav-item px-4"><a class="nav-link text-white" href="#">{{ __('messages.about') }}</a></li>
                        <li class="nav-item px-4"><a class="nav-link text-white" href="{{ route('uploadImage') }}">{{__('image_upload.upload_image')}}</a></li>
                        <li class="nav-item px-4"><a class="nav-link text-white" href="{{ route('showImages') }}">{{__('image_upload.gallery')}}</a></li>
                    </ul>
                </div>
                    <ul class="navbar-nav mr-auto fs-3">
                        <li class="nav-item"><a class="nav-link text-white mx-3" id="ar" href="{{ route('lang.switch', ['locale' => 'ar']) }}">العربية</a></li>
                        <li class="nav-item"><a class="nav-link text-white mx-3" id="en" href="{{ route('lang.switch', ['locale' => 'en']) }}">English</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="#">{{ __('messages.login') }} <i class="bi bi-door-closed-fill"></i></a></li>
                    </ul>
            </div>
        </nav>