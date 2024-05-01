@extends('layouts.layout')
@section('title','phone_test')
@section('content')
        <div class="container-floid d-flex align-items-center justify-content-center m-0" style="height: 83vh;">
            <div id="phonePart" class="w-50 text-center shadow align-items-center" style="">
                <div class="bg-light-red pt-3 m-0"></div>
                <div class="mb-2">
                    <h1 class="mb-0 mt-0 display-6 mt-4" >{{ __('phone_form.insert_phone') }}</h1>
                    <hr class="text-white">
                </div>
                <form method="POST" action="{{route('store')}}" class="mb-4 text-start mx-5" id="phoneForm">
                    @csrf
                    <div class="mb-2">
                        <div class="">
                            <label for="phone">{{ __('phone_form.phone_number') }}</label>
                        </div>
                        <input type="text" class="py-2 w-100 border-0"  id="phone" name="phone" placeholder="{{ __('phone_form.insert_phone') }}" >
                    </div>
                    <p class="phoneErr text-danger"></p>
                    <p class="phoneCountry text-success"></p>
                    <!-- <h5 id="phoneValidate" style="color: red;"> **phone is not correct </h5>  -->
                    <button id="submitButton" class="w-100 border-0 bg-light-red fs-3 p-2 mt-4 text-white">{{ __('messages.insert') }}</button>
                </form>
            </div>
        </div>
@endsection