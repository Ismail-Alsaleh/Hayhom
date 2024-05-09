<div class="row w-100 gallery-container">
    @foreach ($images as $image)

    <article class="main-div col-lg-3 my-5 ">
    <a href="{{ route('image-details',['id' => $image->id]) }}">
        <div class="images h-100">
        <div class="">
            <div class="text-center mb-4">
                <p class="date">{{$image['created_at']}}</p>
                <h4 class="title">{{$image['title']}}</h4>
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
{{ $images->links() }}     