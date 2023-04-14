<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class SiswaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'nama' => 'required',
            'nik' => 'required|numeric',
            'no_telp' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'asal_sekolah' => 'required',
            'jurusan' => 'required',
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
