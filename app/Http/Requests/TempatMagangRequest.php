<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class TempatMagangRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'nama_perusahaan' => 'required',
            'alamat' => 'required',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = json_decode($validator->errors());
        $array = [];

        foreach($errors as $key => $item){
            foreach($item as $error){
                $array[] = [
                    'message' => $error,
                    'field' => $key,
                ];
            }
        }

        throw new HttpResponseException(response()->json([
            'code' => 400,
            'errors' => $array,
            'message' => 'Input validation error'
        ], 400));
    }
}
