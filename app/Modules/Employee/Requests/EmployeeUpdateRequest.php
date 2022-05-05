<?php

namespace App\Modules\Employee\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class EmployeeUpdateRequest extends FormRequest
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
            'email' => 'required|email|string|unique:employees',
            'position' => 'required|string',
            'company_id' => 'required|int|exists:companies,id',
        ];
    }

    public function failedValidation (Validator $validator)
    {
        throw new HttpResponseException(response()->json([$validator->errors()],400));
    }

    public function messages()
    {

    }
}
