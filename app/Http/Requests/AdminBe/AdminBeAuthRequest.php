<?php

namespace App\Http\Requests\AdminBe;

use App\Rules\CheckAdminBeEmail;
use Illuminate\Foundation\Http\FormRequest;

class AdminBeAuthRequest extends FormRequest
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
            'email' => ['required', 'email', new CheckAdminBeEmail],
            'password' => ['required'],
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
            'email.required' => trans('validation.form.input_required', ['attribute' => trans('messages.admin.login.email')]),
            'email.email' => trans('validation.form.ip_regex', ['attribute' => trans('messages.admin.login.email')]),
            'password.required' => trans('validation.form.input_required', ['attribute' => trans('messages.admin.login.password')]),
        );
        return $messages;
    }
}
