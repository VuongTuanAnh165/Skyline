<?php

namespace App\Http\Requests\Ceo;

use App\Rules\CheckPasswordCeo;
use App\Rules\CheckPasswordOldNewRule;
use Illuminate\Foundation\Http\FormRequest;

class CeoChangePasswordRequest extends FormRequest
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
        $rules = [
            'password_old' => ['required', new CheckPasswordCeo],
            'password' => ['required','same:password_confirmation','regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).*$/u', new CheckPasswordOldNewRule($this->password_old, $this->password)],
            'password_confirmation' => 'required_with:password_confirmation',
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
        $messages = array(
            'password_old.required' => trans('messages.api.request.input_required', ['attribute' => "Mật khẩu cũ"]),
            'password_confirmation.required_with' => trans('messages.api.request.input_required_with', ['attribute' => "Nhập lại mật khẩu mới", 'required_with' => "Mật khẩu mới" ]),
            'password.same' => trans('messages.api.request.input_same', ['attribute' => "Mật khẩu mới", 'same' => "Nhập lại mật khẩu mới" ]),
            'password.required' => trans('messages.api.request.input_required', ['attribute' => "Mật khẩu mới"]),
            'password.regex' =>trans('messages.api.request.input_regex', ['attribute' => "Mật khẩu mới"]),
        );
        return $messages;
    }
}
