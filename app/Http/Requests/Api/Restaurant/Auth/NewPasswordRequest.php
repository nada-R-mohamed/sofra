<?php

namespace App\Http\Requests\Api\Restaurant\Auth;

use Illuminate\Foundation\Http\FormRequest;

class NewPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "email" => 'required|email|exists:restaurants,email',
            'pin_code' =>'required|string|exists:restaurants,pin_code',
            'password' =>'required|string|confirmed|min:6',

        ];
    }
}
