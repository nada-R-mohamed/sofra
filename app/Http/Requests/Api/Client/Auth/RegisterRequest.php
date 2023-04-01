<?php

namespace App\Http\Requests\Api\Client\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:100',
            'email' =>'required|email|unique:clients,email',
            'phone' => ['regex:/^01[0125][0-9]{8}$/'],
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
            'region_id' => 'required|integer|exists:regions,id',
            'device_name' => 'required|string'
        ];
    }
}
