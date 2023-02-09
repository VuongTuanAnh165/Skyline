<?php

namespace App\Http\Requests\Ceo;

use Illuminate\Foundation\Http\FormRequest;

class CheckEmailRequest extends FormRequest
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
            'email' => 'required|email|unique:restaurants,email',
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
            'email.required' => trans('validation.form.input_required', ['attribute' => trans('messages.admin.personnel.table.email')]),
            'email.email' => trans('validation.form.ip_regex', ['attribute' => trans('messages.admin.personnel.table.email')]),
            'email.unique' => trans('validation.form.input_unique', ['attribute' => trans('messages.admin.personnel.table.email')]),
        );
        return $messages;
    }
}
