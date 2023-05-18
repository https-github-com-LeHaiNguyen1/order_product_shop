<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreLoginRequest extends FormRequest
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
            'email' =>'required|email',
            'password' => 'required|string|min:6|max:32',
            'remember_me' => 'boolean'
        ];
    }
    public function messages(){
        return [
            'email.required' =>  'Email address is required.',
            'password.required' =>  'Password is required.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        // Tạo phản hồi tùy chỉnh
        $response = [
            'code' => '400',
            'message' => 'Invalid input data',
            'errors' => $validator->errors(),
        ];

        throw new HttpResponseException(response()->json($response, 422)); // 422 là mã lỗi Unprocessable Entity
    }
}
