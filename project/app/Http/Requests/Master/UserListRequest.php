<?php

namespace App\Http\Requests\Master;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\Job;

class UserListRequest extends FormRequest
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
            'id' => ['nullable', 'numeric'],
            'name' => ['nullable', 'max:50'],
            'email' => ['nullable', 'max:256'],
            'self_pr' => ['nullable', 'max:1000'],
            'tel' => ['nullable', 'max:50'],
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
            'subject' => '件名',
            'message' => 'メッセージ',
            'send' => '送信済',
        ];
    }

    /**
     * 特殊なバリデーションを行う場合はここに処理を記述する
     *
     * @return void
     */
    public function withValidator($validator)
    {
        /* ここにバリデーションを書く */
        $validator->after(function ($validator) {
            if (
                !empty($this->input('id'))
                && Job::find($this->input('id'))->updated_at > $this->input('updated_at')
            ) {
                $validator->errors()->add('updated_at', 'すでに変更されたデータの可能性があります。最新の状態で再度実行してください。');
            }
        });
    }

    /**
     * バリデーションエラー後の処理を変える場合はここに処理を記述する
     * デフォルトはリダイレクト
     *
     * @return array
     */
    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'status' => 422,
            'errors' => $validator->errors(),
        ], 422);
        throw new HttpResponseException($response);
    }
}
