<?php

namespace App\Http\Requests\Master;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class JobListRequest extends FormRequest
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
            'title' => ['nullable', 'max:50'],
            'content' => ['nullable', 'max:1000'],
            'attention' => ['nullable', 'integer', 'min:0|max:1'],
            'jobCategoryId' => ['nullable', 'numeric', 'min:0|max:1'],
            'price' => ['nullable', 'numeric'],
            'welfare' => ['nullable', 'max:1000'],
            'holiday' => ['nullable', 'max:1000'],
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'id' => 'id',
            'title' => 'タイトル',
            'content' => '内容',
            'attention' => '注目',
            'jobCategoryId' => 'カテゴリ',
            'price' => '金額',
            'welfare' => '福利厚生',
            'holiday' => '休日',
        ];
    }
}
