<?php

namespace App\Http\Requests\Api;

use App\Rules\CheckCodeForgotPasswordRule;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class ApiVerifyForgotPasswordRequest extends FormRequest
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
            'code' => ['required','max:6','min:6', new CheckCodeForgotPasswordRule($this->route('id'))],
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
