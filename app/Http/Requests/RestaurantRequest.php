<?php

namespace App\Http\Requests;

use App\Rules\CheckEmailEditRestaurant;
use Illuminate\Foundation\Http\FormRequest;

class RestaurantRequest extends FormRequest
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
            'name' => 'required|min:3|max:150',
            'email' => ['required', 'email', new CheckEmailEditRestaurant],
            'phone' => 'required|min:10|max:11|regex:/^[0-9]*$/',
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
            'name.required' => trans('validation.form.input_required', ['attribute' => trans('messages.admin.restaurant.form.name')]),
            'name.min' => trans('validation.form.input_min', ['attribute' => trans('messages.admin.restaurant.form.name'), 'min' => "3"]),
            'name.max' => trans('validation.form.input_max', ['attribute' => trans('messages.admin.restaurant.form.name'), 'max' => "150"]),
            'email.required' => trans('validation.form.input_required', ['attribute' => trans('messages.admin.personnel.table.email')]),
            'email.email' => trans('validation.form.ip_regex', ['attribute' => trans('messages.admin.personnel.table.email')]),
            'phone.required' => trans('validation.form.input_required', ['attribute' => trans('messages.admin.personnel.table.phone')]),
            'phone.min' => trans('validation.form.ip_regex', ['attribute' => trans('messages.admin.personnel.table.phone')]),
            'phone.max' => trans('validation.form.ip_regex', ['attribute' => trans('messages.admin.personnel.table.phone')]),
            'phone.regex' => trans('validation.form.ip_regex', ['attribute' => trans('messages.admin.personnel.table.phone')]),
            'phone.unique' => trans('validation.form.input_unique', ['attribute' => trans('messages.admin.personnel.table.phone')]),
        );
        return $messages;
    }
}
