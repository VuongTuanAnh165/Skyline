<?php

namespace App\Http\Requests;

use App\Models\Policy;
use App\Rules\UniqueRule;
use Illuminate\Foundation\Http\FormRequest;

class PolicyRequest extends FormRequest
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
            'name' => ['required', 'unique:policies,name,' . $this->route('id')],
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
            'name.required' => trans('validation.form.input_required', ['attribute' => trans('messages.admin.policy.table.name')]),
            'name.unique' => trans('validation.form.input_unique', ['attribute' => trans('messages.admin.policy.table.name')]),
        );
        return $messages;
    }
}
