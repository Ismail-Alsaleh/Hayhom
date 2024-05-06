@extends('layouts.layout')
@section('title','image_gallery')
@section('content')
<link rel="stylesheet" href="{{asset('css/galary.css')}}">
<section class="container w-75 bg-white" style="height:86vh">
    <div class="row">
        @foreach ($images as $image)
        <div class="col-12-lg" data-toggle="modal" data-target="{{'#a' . $image['id']}}">
            <img src="{{ asset('images/thumbnails/' . $image['image']) }}" alt="{{ $image['title'] }}"  />
            <span class="description">{{ $image['title'] }}</span>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="{{'a' . $image['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ $image['title'] }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <div class="">
                            <img src="{{ asset('images/thumbnails/' . $image['image']) }}" alt="{{ $image['title'] }}" />
                        </div>
                        <div class="">
                            <img src="{{ asset('images/200x200/' . $image['image']) }}" alt="{{ $image['title'] }}" />
                        </div>
                        <div class="">
                            <img src="{{ asset('images/500x500/' . $image['image']) }}" alt="{{ $image['title'] }}" />
                        </div>
                        <div class="">
                            <img src="{{ asset('images/800x800/' . $image['image']) }}" alt="{{ $image['title'] }}" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @foreach ($images as $image)
        <div class="col-12-lg">
            <img src="{{ asset('images/thumbnails/' . $image['image']) }}" alt="{{ $image['title'] }}" />
            <span class="description">{{ $image['title'] }}</span>
        </div>           
        @endforeach
        @foreach ($images as $image)
        <div class="col-12-lg">
            <img src="{{ asset('images/thumbnails/' . $image['image']) }}" alt="{{ $image['title'] }}" />
            <span class="description">{{ $image['title'] }}</span>
        </div>           
        @endforeach
        @foreach ($images as $image)
        <div class="col-12-lg">
            <img src="{{ asset('images/thumbnails/' . $image['image']) }}" alt="{{ $image['title'] }}" />
            <span class="description">{{ $image['title'] }}</span>
        </div>           
        @endforeach
    </div>
</section>

@endsection

@push('js_file')

    <script src="{{asset('js/gallery.js')}}"></script>
@endpush