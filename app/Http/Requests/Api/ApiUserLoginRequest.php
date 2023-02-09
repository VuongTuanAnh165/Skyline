<?php

namespace App\Http\Requests\Api;

use App\Rules\ExistEmailUser;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class ApiUserLoginRequest extends FormRequest
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
        $this->type = trans('messages.api.constants.arrOneTwo');
        $rules = [
            'email' => ['required', 'email', new ExistEmailUser],
            'password' => 'required|min:6',
            'device' => ['nullable','in:' . implode(',', $this->type)],
            'device_token' => 'required_unless:device,null',
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
            'email.required' => trans('messages.api.request.input_required', ['attribute' => "Email hoặc số điện thoại"]),
            'password.min' => trans('messages.api.request.input_min', ['attribute' => "Mật khẩu", 'min' => "6" ]),
            'password.required' => trans('messages.api.request.input_required', ['attributes' => "Mật khẩu"]),
            'device.in' => trans('messages.api.request.input_in', ['attribute' => "Thiết bị"]),
            'device_token.required_unless' => trans('messages.api.request.input_required_unless', ['attribute' => "Mã thiết bị", 'status'=> "thiết bị dùng", 'required_unless' => "APP" ]),
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
