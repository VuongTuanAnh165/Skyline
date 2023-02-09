<?php

namespace App\Http\Requests;

use App\Models\Position;
use App\Rules\UniqueRule;
use Illuminate\Foundation\Http\FormRequest;

class PositionRequest extends FormRequest
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
        $input_unique = trans('validation.form.input_unique', ['attribute' => trans('messages.admin.position.table.name')]);
        $rules = [
            'name' => ['required', new UniqueRule($this->route('id'), Position::class, $this->name, $input_unique)],
            'wage' => 'required|regex:/^[0-9]*$/|integer|min:1',
            'amount_personnel' => 'required|integer|min:1',
            'work_type' => 'required',
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
            'name.required' => trans('validation.form.input_required', ['attribute' => trans('messages.admin.position.table.name')]),
            'wage.required' => trans('validation.form.input_required', ['attribute' => trans('messages.admin.position.table.wage')]),
            'wage.regex' => trans('validation.form.ip_regex', ['attribute' => trans('messages.admin.position.table.regex')]),
            'wage.min' => trans('validation.form.input_min_value', ['attribute' => trans('messages.admin.position.table.wage'), 'min_value' => "1"]),
            'amount_personnel.required' => trans('validation.form.input_required', ['attribute' => trans('messages.admin.position.table.amount_personnel')]),
            'amount_personnel.min' => trans('validation.form.input_min_value', ['attribute' => trans('messages.admin.position.table.amount_personnel'), 'min_value' => "1"]),
            'work_type.required' => trans('validation.form.input_required', ['attribute' => trans('messages.admin.position.table.work_type')]),
        );
        return $messages;
    }
}
