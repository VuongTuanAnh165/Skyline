<?php

namespace App\Http\Requests\Api;

use App\Rules\CheckCodeForgotPasswordRule;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class CreatePasswordRequest extends FormRequest
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
            'code' => ['required', 'max:6', 'min:6', new CheckCodeForgotPasswordRule($this->route('id'))],
            'password' => 'min:6|required|same:password_confirmation|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).*$/u',
            'password_confirmation' => 'required_with:password_confirmation|min:6',
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
            'code.max' => trans('messages.api.request.input_max', ['attributes' => "code", 'max' => "6"]),
            'code.min' => trans('messages.api.request.input_min', ['attributes' => "code", 'min' => "6"]),
            'password.min' => trans('messages.api.request.input_min', ['attributes' => "password", 'min' => "6"]),
            'password_confirmation.required_with' => trans('messages.api.request.input_required_with', ['attributes' => "password_confirmation", 'required_with' => "password"]),
            'password_confirmation.min' => trans('messages.api.request.input_min', ['attributes' => "password_confirmation", 'min' => "6"]),
            'password.same' => trans('messages.api.request.input_same', ['attributes' => "password", 'same' => "password_confirmation"]),
            'password.required' => trans('messages.api.request.input_required', ['attributes' => "password"]),
            'password.regex' => trans('messages.api.request.input_regex', ['attribute' => "Mật khẩu"]),
        );
        return $messages;
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(
            response()->json([
                'errors' => $errors,
                'code' => JsonResponse::HTTP_UNPROCESSABLE_ENTITY,
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
