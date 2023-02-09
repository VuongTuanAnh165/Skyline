<?php

namespace App\Http\Requests\AdminBe;

use App\Models\ServiceGroup;
use App\Rules\UniqueRule;
use Illuminate\Foundation\Http\FormRequest;

class AdminBeServiceGroupRequest extends FormRequest
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
            'name' => 'required|unique:service_groups,name,' . $this->route('id'),
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
            'name.required' => trans('validation.form.input_required', ['attribute' => trans('messages.admin.service_group.table.name')]),
            'name.unique' => trans('validation.form.input_unique', ['attribute' => trans('messages.admin.service_group.table.name')]),
        );
        return $messages;
    }
}
