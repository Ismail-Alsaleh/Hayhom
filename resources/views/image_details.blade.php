@extends('layouts.layout')
@section('title','image_details')
@section('content')
<style>
    .thumbnails {
    display: flex;
    margin: 1rem auto 0;
    padding: 0;
    justify-content: center;
}

.thumbnail {
    position: relative;
    width: 70px;
    height: 70px;
    overflow: hidden;
    list-style: none;
    margin: 0 0.2rem;
    cursor: pointer;
}

.thumbnail img {
    width: 100%;
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
}
.thumbnail .low-opacity {
    opacity: 0.5; /* Adjust opacity as needed */
}
.splide__list{
    align-items: center;
}
</style>
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
<link href="{{asset('css/splide.min.css')}}" rel="stylesheet">
<link href="{{asset('css/splide-default.min.css')}}" rel="stylesheet">
<div class="text-center">
    <h1>{{$image['title']}}</h1>
    <hr>
</div>
<ul id="thumbnails" class="thumbnails">
  <li class="thumbnail">
    <img src="{{ route('imageCache', ['template' => 'thumbnails', 'fileName' => $image['image']]) }}" alt="">
    <img class="low-opacity" src="https://fakeimg.pl/80x80/ffffff/909090?text=800x800" alt="">
  </li>
  <li class="thumbnail">
    <img src="{{ route('imageCache', ['template' => 'thumbnails', 'fileName' => $image['image']]) }}" alt="">
    <img class="low-opacity" src="https://fakeimg.pl/80x80/ffffff/909090?text=500x500" alt="">
  </li>
  <li class="thumbnail">
    <img src="{{ route('imageCache', ['template' => 'thumbnails', 'fileName' => $image['image']]) }}" alt="">
    <img class="low-opacity" src="https://fakeimg.pl/80x80/ffffff/909090?text=200x200" alt="">
  </li>
  <li class="thumbnail">
    <img src="{{ route('imageCache', ['template' => 'thumbnails', 'fileName' => $image['image']]) }}" alt="">
    <img class="low-opacity" src="https://fakeimg.pl/80x80/ffffff/909090?text=80x80" alt="">
  </li>
</ul>

<div class="splide my-3" role="group" aria-label="Splide Basic HTML Example">
  <div class="splide__track">
		<ul class="splide__list text-center">
			<li class="splide__slide"><img src="{{ route('imageCache', ['template' => '800x800', 'fileName' => $image['image']]) }}" alt=""></li>
			<li class="splide__slide"><img src="{{ route('imageCache', ['template' => '500x500', 'fileName' => $image['image']]) }}" alt=""></li>
            <li class="splide__slide"><img src="{{ route('imageCache', ['template' => '200x200', 'fileName' => $image['image']]) }}" alt=""></li>
            <li class="splide__slide"><img src="{{ route('imageCache', ['template' => 'thumbnails', 'fileName' => $image['image']]) }}" alt=""></li>
            
		</ul>
  </div>
</div>


@endsection
@push('js_file')
<script>
    document.addEventListener( 'DOMContentLoaded', function() {
        var splide = new Splide( '.splide', {
            pagination: false,
        });
        splide.mount();

        var thumbnails = document.getElementsByClassName( 'thumbnail' );
        for ( var i = 0; i < thumbnails.length; i++ ) {
            initThumbnail( thumbnails[ i ], i );
        }

        function initThumbnail( thumbnail, index ) {
            thumbnail.addEventListener( 'click', function () {
                splide.go( index );
            } );
        }



    });

// The function to initialize each thumbnail.

</script>
@endpush