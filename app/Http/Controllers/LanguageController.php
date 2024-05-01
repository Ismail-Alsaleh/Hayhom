<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;

class LanguageController extends Controller
{
    public function switchLocale($locale)
    {
        if (in_array($locale, ['en', 'ar'])) {
            // Session::put('locale', $locale);
            App::setLocale($locale);
        }

        return Redirect::route('lang.switch');
    }
}
