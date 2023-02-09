<?php

namespace App\Http\Requests\Api;

use App\Rules\CheckPasswordOldNewRule;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class ApiUserChangePasswordRequest extends FormRequest
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
            'password_old' => 'required|min:6',
            'password' => ['min:6','required','same:password_confirmation','regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).*$/u', new CheckPasswordOldNewRule($this->password_old, $this->password)],
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
            'password_old.min' => trans('messages.api.request.input_min', ['attributes' => "password_old", 'min' => "6" ]),
            'password_old.required' => trans('messages.api.request.input_required', ['attributes' => "password_old"]),
            'password.min' => trans('messages.api.request.input_min', ['attributes' => "password", 'min' => "6" ]),
            'password_confirmation.required_with' => trans('messages.api.request.input_required_with', ['attributes' => "password_confirmation", 'required_with' => "password" ]),
            'password_confirmation.min' => trans('messages.api.request.input_min', ['attributes' => "password_confirmation", 'min' => "6" ]),
            'password.same' => trans('messages.api.request.input_same', ['attributes' => "password", 'same' => "password_confirmation" ]),
            'password.required' => trans('messages.api.request.input_required', ['attributes' => "password"]),
            'password.regex' =>trans('messages.api.request.input_regex', ['attribute' => "Mật khẩu"]),
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
