<?php

namespace App\Http\Requests\User;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
        $column = 'email';
        $today = Carbon::now()->addDay()->format('Y-m-d');
        $rules = [
            'name' => 'required|max:255',
            'email' =>['required','email','max:100','unique:users,'.$column ],
            'password' => 'min:6|required|same:password_confirmation|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).*$/u',
            'password_confirmation' => 'required_with:password|min:6',
        ];
        return $rules;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        $messages = [
            'name.required' => trans('messages.api.request.input_required', ['attribute' => "Tên"]),
            'email.required' => trans('messages.api.request.input_required', ['attribute' => "Email"]),
            'name.max' => trans('messages.api.request.input_max', ['attribute' => "Tên"]),
            'email.max' => trans('messages.api.request.input_max', ['attribute' => "Email"]),
            'password.min' => trans('messages.api.request.input_min', ['attribute' => "password"]),
            'email.unique' => trans('messages.api.request.input_unique', ['attribute' => "Email"]),
            'email.email'=> trans('messages.api.request.input_regex', ['attribute' => "Email"]),
            'password_confirmation.required_with' => trans('messages.api.request.input_required_with', ['attribute' => "Nhập lại mật khẩu", 'required_with' => "Mật khẩu" ]),
            'password.same' => trans('messages.api.request.input_same', ['attribute' => "Mật khẩu", 'same' => "nhập lại mật khẩu" ]),
            'password.regex' =>trans('messages.api.request.input_regex', ['attribute' => "Mật khẩu"]),
            'password_confirmation.min' => trans('messages.api.request.input_min', ['attribute' => "Nhập lại mật khẩu", 'min' => "6" ]),
            'password.required' => trans('messages.api.request.input_required', ['attributes' => "password"]),
        ];
        return $messages;
    }
}
