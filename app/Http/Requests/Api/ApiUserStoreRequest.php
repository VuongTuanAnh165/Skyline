<?php

namespace App\Http\Requests\Api;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiUserStoreRequest extends FormRequest
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
        $this->gender = trans('messages.api.constants.arrOneTwo');
        $column = 'email';
        $today = Carbon::now()->addDay()->format('Y-m-d');
        $rules = [
            'name' => 'required|max:255',
            'email' =>['required','email','max:100','unique:users,'.$column ],
            'password' => 'min:6|required|same:password_confirmation|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).*$/u',
            'password_confirmation' => 'required_with:password|min:6',
            'gender' => ['required','in:' . implode(',', $this->gender)],
            'address' => 'required|max:255',
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
        $messages = [
            'name.required' => trans('messages.api.request.input_required', ['attribute' => "Tên"]),
            'email.required' => trans('messages.api.request.input_required', ['attribute' => "Email"]),
            'gender.required' => trans('messages.api.request.input_required', ['attribute' => "Giới tính"]),
            'name.max' => trans('messages.api.request.input_max', ['attribute' => "Tên"]),
            'email.max' => trans('messages.api.request.input_max', ['attribute' => "Email"]),
            'address.max' => trans('messages.api.request.input_max', ['attribute' => "Địa chỉ"]),
            'password.min' => trans('messages.api.request.input_min', ['attribute' => "password"]),
            'email.unique' => trans('messages.api.request.input_unique', ['attribute' => "Email"]),
            'email.email'=> trans('messages.api.request.input_regex', ['attribute' => "Email"]),
            'password_confirmation.required_with' => trans('messages.api.request.input_required_with', ['attribute' => "Nhập lại mật khẩu", 'required_with' => "Mật khẩu" ]),
            'password.same' => trans('messages.api.request.input_same', ['attribute' => "Mật khẩu", 'same' => "nhập lại mật khẩu" ]),
            'password.regex' =>trans('messages.api.request.input_regex', ['attribute' => "Mật khẩu"]),
            'password_confirmation.min' => trans('messages.api.request.input_min', ['attribute' => "Nhập lại mật khẩu", 'min' => "6" ]),
            'gender.in' => trans('messages.api.request.input_in', ['attribute' => "Giới tính"]),
            'password.required' => trans('messages.api.request.input_required', ['attributes' => "password"]),
            'address.required' => trans('messages.api.request.input_required', ['attribute' => "Địa chỉ"]),
        ];
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
