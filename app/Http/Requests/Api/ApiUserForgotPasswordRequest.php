<?php

namespace App\Http\Requests\Api;

use App\Rules\ExistEmailUser;
use Illuminate\Foundation\Http\FormRequest;

class ApiUserForgotPasswordRequest extends FormRequest
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
            'email' => ['required', 'email', new ExistEmailUser],
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
            'email.required' => trans('api::messages.request.input_required', ['attributes' => "email"]),
        );
        return $messages;
    }
}
