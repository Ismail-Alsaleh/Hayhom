<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreatePhoneRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function failedValidation(Validator $validator)
    {
        $var ='';
        for( $i=0;$i<count($validator->errors());$i++){
            $var = $validator->errors()->first();
            break; 
        }
        throw new HttpResponseException(response()->json(
            ['errors'   =>  $validator->errors()]),405);
    }
    public function rules()
    {
        return [
            'phone' => 'phone:AUTO,mobile|required',
        ];
    }
    public function messages()
    {
        return [
            'phone.required' => 'ENTER A PHONE NUMBER',
        ];
    }
}
