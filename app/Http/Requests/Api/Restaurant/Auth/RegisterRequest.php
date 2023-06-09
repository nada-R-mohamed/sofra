<?php

namespace App\Http\Requests\Api\Restaurant\Auth;

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
            'email' =>'required|email|unique:restaurants,email',
            'phone' => ['required','regex:/^01[0125][0-9]{8}$/',],
            'minimum_order' => 'required|numeric|between:0,9999.99',
            'delivery_cost' => 'required|numeric|between:0,9999.99',
            'whatsapp' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg"',
            'status' => 'required|in:open,closed',
            'contact_phone' => ['required','regex:/^01[0125][0-9]{8}$/'],
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
            'region_id' => 'required|integer|exists:regions,id',
            'category_id' => 'required|integer|exists:categories,id',
            'device_name' => 'required|string'
        ];
    }
}
