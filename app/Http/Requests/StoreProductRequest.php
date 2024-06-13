<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'price_regular' => ['required'],
            'catelogue_id',
            'slug',
            'sku' => ['required'],
            'img_thumbnail',
            'price_regular',
            'price_sale',
            'description' => ['required'],
            'content' => ['required'],
            'material' => ['required'],
            'user_manual' => ['required'],
        ];
    }


    public function attributes(): array
    {
        return [
            'name' => 'Tên sản phẩm',
            'price_regular' => 'Giá bán thường',
            'sku' => 'Mã sãn phẩm',
            'content' => 'Nội dung',
            'material' => 'Chất liệu',
            'user_manual' => 'Cách sử dụng',
        ];
    }
}
