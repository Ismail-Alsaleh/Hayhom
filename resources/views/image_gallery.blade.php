@extends('layouts.layout')
@section('title','image_gallery')
@section('content')
<link rel="stylesheet" href="{{asset('css/galary.css')}}">

<section style="min-height: 45rem;">
    <div class="container mt-4 ">
        <div class="text-center w-100">
            <h1>{{ __('image_upload.gallery') }}</h1>
        </div>
        <hr>
        <div class="d-flex filter-form">
            <div class="input-group mx-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" ><i class="bi bi-sort-down-alt"></i></span>
                </div>
                <select name="sort" id="sort" class="form-control" >
                    <option value="date_desc">{{ __('messages.date') . ' ' . __('messages.descending') }}</option>
                    <option value="date_asc">{{ __('messages.date') . ' ' . __('messages.ascending') }}</option>
                    <option value="title_desc">{{ __('messages.title') . ' ' . __('messages.descending') }}</option>
                    <option value="title_asc">{{ __('messages.title') . ' ' . __('messages.ascending') }}</option>
                </select>
            </div>

            <div class="input-group mx-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" >{{ __('messages.from') }}</span>
                </div>
                <input type="date" id="greaterThan" class="form-control">
            </div>

            <div class="input-group mx-2">
                <div class="input-group-prepend">
                    <span class="input-group-text">{{ __('messages.to') }}</span>
                </div>
                <input type="date" id="lessThan" class="form-control">
            </div>

            <div class="input-group mx-2">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                </div>
                <input id="titleOrTagSearch" type="text" class="form-control" placeholder="{{ __('gallery.insert_tag_title') }}" style="margin-left:auto;">
            </div>
            <a id="sortLink" href="{{route('sort')}}"></a>
        </div>
        <hr>
        <div class="row gallery-sorter">
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
                                <img class="img-fluid" src="{{ route('imageCache', ['template' => '200x200', 'fileName' => $image['image']]) }}" alt="Image Description{{$image['image']}}">
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
                <div class="pagination-container">
                </div>
        </div>
    </div>
</section>
@endsection
@push('js_file')
<script>
function findFilterAttr(){
    let searchValue = $('#titleOrTagSearch').val().toLowerCase();
    let greaterThan = $('#greaterThan').val();
    if(greaterThan ==''){
        greaterThan = undefined;
    }
    let lessThan = $('#lessThan').val();
    if(lessThan == ''){
        lessThan = undefined;
    }
    return [searchValue, greaterThan, lessThan, 1];
}
function updatePage(response){
    var html = '<div class="row w-100 gallery-container">';
    response.images.data.foreach(function(image){
        let imageUrl = "{{ route('imageCache', ['template' => '200x200', 'fileName' => ':fileName']) }}";
        imageUrl = imageUrl.replace(':fileName', response.images[key].image);
        console.log(`Image Title: ${response.images[key].title}`);
        html += `
            <article class="main-div col-lg-3 my-5 ">
                <a href="{{ route('image-details', ['id' => '']) }}/${response.images[key].id}">
                    <div class="images h-100">
                        <div class="">
                            <div class="text-center mb-4">
                                <p class="date">${response.images[key].created_at}</p>
                                <h4 class="title">${response.images[key].title}</h4>
                            </div>
                            <div class="text-center mb-4">
                                <img class="img-fluid" src="${imageUrl}" alt="Image Description">
                            </div>
                        </div>
                        <div class="w-100 text-center button-div">
                            <div>`;
        response.images[key].tags.forEach(function(tag) {
            html += `<span class="tag ${tag.name.en}">${tag.name.en}</span>`;
        });
        html += `</div>
                            <button class="w-100 sizeButton" action="{{ route('showImages') }}">View image in different sizes</button>
                        </div>
                    </div>
                </a>
            </article>`;
})
    html += `</div>
    <div class="pagination-container">
    </div>`;
    $('.gallery-sorter').html(html);
}
$('#sort').on('change',function(){
    let [searchValue,greaterThan,lessThan,pageNumber] = findFilterAttr();
    applyfilters(searchValue,greaterThan,lessThan,pageNumber);
});
</script>
<script src="{{asset('js/gallery.js')}}"></script>
@endpush