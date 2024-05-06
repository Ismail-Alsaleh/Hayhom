@extends('layouts.layout')
@section('title','image_gallery')
@section('content')
<link rel="stylesheet" href="{{asset('css/galary.css')}}">
<section class="">
    <div class="container mt-4 ">
        <div class="section-header text-center">
            <h1>Gallery</h1>
        </div>
        <div class="row">
                <div class="row">
                    <!-- All Posts -->
                    @foreach ($images as $image)

                    <article class="col-lg-3 my-5 "> <!-- Added px-md-3 class for spacing -->
                    <a href="{{ route('image-details',['id' => $image->id]) }}">
                        <div class="images h-100">
                        <div class="">
                            <div class="text-center mb-4">
                                <h4 class="">{{$image['title']}}</h4>
                            </div>
                            <div class="text-center mb-4">
                                <img class="img-fluid" src="{{ asset('images/200x200/' . $image['image']) }}" alt="Image Description">
                            </div>

                        </div>
                        <div class="w-100 text-center button-div">
                                <button class="w-100 sizeButton" action="{{route('showImages')}}">View image in different sizes</button>
                            </div>
                        </div>
                        </a>
                    </article>

                    @endforeach
                </div>
        </div>
    </div>
</section>

@endsection

@push('js_file')

    <script src="{{asset('js/gallery.js')}}"></script>
@endpush