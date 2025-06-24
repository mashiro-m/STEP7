<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'company_id' => 'required|exists:companies,id',
            'product_name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'comment' => 'nullable|string',
            'img_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }


    public function messages()
{
    return [
        'company_id.required' => 'メーカーを選択してください。',
        'company_id.exists' => '選択されたメーカーは存在しません。',
        'product_name.required' => '商品名を入力してください。',
        'price.required' => '価格を入力してください。',
        'price.integer' => '価格は整数で入力してください。',
        'price.min' => '価格は0円以上にしてください。',
        'stock.required' => '在庫数を入力してください。',
        'stock.integer' => '在庫数は整数で入力してください。',
        'stock.min' => '在庫数は0以上にしてください。',
        'img_path.image' => '画像ファイルを選択してください。',
        'img_path.mimes' => '画像形式はjpeg, png, jpg, gifのいずれかにしてください。',
        'img_path.max' => '画像サイズは2MB以下にしてください。',
    ];
}

}
