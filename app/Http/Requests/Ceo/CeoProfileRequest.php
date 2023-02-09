<?php

namespace App\Http\Requests\Ceo;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CeoProfileRequest extends FormRequest
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
            'name' => 'required',
            'avatar' => 'nullable',
            'email' => 'required|email|unique:ceos,email,' . Auth::guard('ceo')->user()->id,
            'phone' => 'required|min:10|max:11|regex:/^[0-9]*$/|unique:ceos,phone,' . Auth::guard('ceo')->user()->id,
            'address' => 'required',
            'cmnd' => 'required|regex:/^[0-9]*$/',
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
            'name.required' => trans('validation.form.input_required', ['attribute' => 'Họ tên']),
            'email.required' => trans('validation.form.input_required', ['attribute' => 'Email']),
            'email.email' => trans('validation.form.ip_regex', ['attribute' => 'Email']),
            'email.unique' => trans('validation.form.input_unique', ['attribute' => 'Email']),
            'phone.required' => trans('validation.form.input_required', ['attribute' => 'Số điện thoại']),
            'phone.min' => trans('validation.form.ip_regex', ['attribute' => 'Số điện thoại']),
            'phone.max' => trans('validation.form.ip_regex', ['attribute' => 'Số điện thoại']),
            'phone.regex' => trans('validation.form.ip_regex', ['attribute' => 'Số điện thoại']),
            'phone.unique' => trans('validation.form.input_unique', ['attribute' => 'Số điện thoại']),
            'address.required' => trans('validation.form.input_required', ['attribute' => 'Địa chỉ']),
            'cmnd.required' => trans('validation.form.input_required', ['attribute' => 'CMND']),
            'cmnd.regex' => trans('validation.form.ip_regex', ['attribute' => 'CMND']),
        );
        return $messages;
    }
}
