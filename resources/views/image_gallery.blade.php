@extends('layouts.layout')
@section('title','image_gallery')
@section('content')
<link rel="stylesheet" href="{{asset('css/galary.css')}}">
<style>
    .tag {

    display: inline-block;
    padding: 2px 6px;
    background-color: #f0f0f0;
    border-radius: 4px;
    margin: 4px;
}
</style>
<section class="">
    <div class="container mt-4 ">
        <div class="text-center w-100">
            <h1>Gallery</h1>
                <input id="tagSearch" type="text" placeholder="Search for a tag" style="margin-left:auto;">

        </div>
        <hr>
        <div class="row ">
                <div class="row w-100">
                    @foreach ($images as $image)

                    <article class="main-div col-lg-3 my-5 ">
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
                        <div class="">
                            @foreach ($image->tags as $tag)
                                <span class="tag {{ $tag->name }}">{{ $tag->name }}</span>
                            @endforeach
                            </div>
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