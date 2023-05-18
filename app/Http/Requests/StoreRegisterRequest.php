<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreRegisterRequest extends FormRequest
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
            'name' =>'sometimes|required',
            'email' =>'required|email|unique:users',
            'password' => 'required|min:6|max:32',
            'confirm_password' => 'sometimes|required|min:6|max:32|same:password',
            'remember_me' => 'boolean'
        ];
    }
    public function messages(){
        return [
            'email.required' =>  'Email address is required.',
            'email.email' =>  'Invalid email address.',
            'email.unique' =>  'Email already exists',
            'password.required' =>  'Password is required.',
            'password.min' =>  'The password must be at least 6 characters and no more than 32 characters.',
            'password.max' =>  'The password must be at least 6 characters and no more than 32 characters.',
            'confirm_password.required' =>  'Password confirmation is required.',
            'confirm_password.min' =>  'The password must be at least 6 characters and no more than 32 characters.',
            'confirm_password.max' =>  'The password must be at least 6 characters and no more than 32 characters.',
            'confirm_password.same' => 'Password confirmation does not match password.',
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
