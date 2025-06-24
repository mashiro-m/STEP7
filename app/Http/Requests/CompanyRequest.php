<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'company_name' => 'required|string|max:255',
            'street_address' => 'required|string|max:255',
            'representative_name' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'company_name.required' => ':attributeは必須です。',
            'street_address.required' => ':attributeは必須です。',
            'representative_name.required' => ':attributeは必須です。',
            'company_name.max' => ':attributeは:max文字以内で入力してください。',
            'street_address.max' => ':attributeは:max文字以内で入力してください。',
            'representative_name.max' => ':attributeは:max文字以内で入力してください。',
        ];
    }
}
