<?php

namespace App\Modules\User\Requests;

use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRegisterRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|email|string|unique:users',
            'password' => 'required|string|confirmed',
        ];
    }

    public function failedValidation(ValidationValidator $validator)
    {
        throw new HttpResponseException(response()->json([$validator->errors()],402));
    }

    //messages
}
