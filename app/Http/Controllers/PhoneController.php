<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePhoneRequest;
use App\Models\MyPhone;
use Illuminate\Http\Request;
use Propaganistas\LaravelPhone\PhoneNumber;
use Propaganistas\LaravelPhone\Validation\Phone;

class PhoneController extends Controller
{
    public function index()
    {
        return view('phone_form');
    }

    public function store(CreatePhoneRequest $request)
    {
        $phoneNumber = $request->input('phone');
        $parsedNumber = new PhoneNumber($phoneNumber);
        $countryInfo = $parsedNumber->getCountry();
        
        MyPhone::create([
            'phone' => $request->input('phone'),
        ]);
        return response()->json(['success'=> 'Phone number saved successfully.', 'country'=>'This Mobile-Number is valid in '.$countryInfo]);
    }
}
