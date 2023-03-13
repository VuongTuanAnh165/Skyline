<?php

namespace App\Http\Requests\User;

use App\Rules\CheckCodeRegisterRule;
use Illuminate\Foundation\Http\FormRequest;

class UserVerifyRequest extends FormRequest
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
            'code' => ['required','max:6','min:6', new CheckCodeRegisterRule($this->route('id'))],
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
            'code.required' => trans('messages.api.request.input_required', ['attributes' => "code"]),
            'code.max' => trans('messages.api.request.input_max', ['attributes' => "code", 'max' => "6" ]),
            'code.min' => trans('messages.api.request.input_min', ['attributes' => "code", 'min' => "6" ]),
        );
        return $messages;
    }
}
