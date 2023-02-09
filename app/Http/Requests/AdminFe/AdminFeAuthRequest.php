<?php

namespace App\Http\Requests\AdminFe;

use App\Rules\CheckAdminFeEmail;
use Illuminate\Foundation\Http\FormRequest;

class AdminFeAuthRequest extends FormRequest
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
            'email' => ['required', 'email', new CheckAdminFeEmail],
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
