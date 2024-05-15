<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateImageRequest extends FormRequest
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
    public function rules()
    {
        return [
            'title' => 'required|max:50|not_regex:/[^<]*<[^>]*>/', 
            'image' => 'required',
            'tags' => 'required'
        ];
    }
    // protected function prepareForValidation()
    // {
    //     $this->merge([
    //         'title' => strip_tags(html_entity_decode($this->title)),
    //     ]);
    // }

    public function failedValidation(Validator $validator)
    {
        $var ='';
        for( $i=0;$i<count($validator->errors());$i++){
            $var = $validator->errors()->first();
            break; 
        }
        throw new HttpResponseException(response()->json(
            ['errors'   =>  $validator->errors()]));
    }
}
