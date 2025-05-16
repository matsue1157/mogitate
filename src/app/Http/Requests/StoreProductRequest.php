<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|between:0,10000',
            'season_id' => ['required', 'array', 'min:1'],
            'season_id.*' => ['integer', 'exists:seasons,id'],
            'description' => 'required|string|max:120',
            'image' => 'required|mimes:png,jpeg|file|max:10240',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => '商品名を入力してください',
            'price.required' => '値段を入力してください',
            'price.numeric' => '数値で入力してください',
            'price.between' => '0~10000円以内で入力してください',
            'season_id.required' => '季節を選択してください',
            'season_id.array' => '季節を選択してください',
            'season_id.*.integer' => '正しい季節IDを選択してください',
            'season_id.*.exists' => '選択された季節が無効です',
            'description.required' => '商品説明を入力してください',
            'description.max' => '120文字以内で入力してください',
            'image.required' => '商品画像を登録してください',
            'image.mimes' => '「.png」または「.jpeg」形式でアップロードしてください',
            'image.max' => '画像サイズは10MB以内にしてください',
        ];
    }
}
