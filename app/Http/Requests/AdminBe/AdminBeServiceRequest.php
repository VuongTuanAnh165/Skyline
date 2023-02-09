<?php

namespace App\Http\Requests\AdminBe;

use Illuminate\Foundation\Http\FormRequest;

class AdminBeServiceRequest extends FormRequest
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
            'name' => 'required|unique:services,name,' . $this->route('id'),
            'service_group_id' => 'required',
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
            'name.required' => trans('validation.form.input_required', ['attribute' => trans('messages.admin.service.table.name')]),
            'service_group_id.required' => trans('validation.form.input_required', ['attribute' => trans('messages.admin.service_group.title')]),
            'name.unique' => trans('validation.form.input_unique', ['attribute' => trans('messages.admin.service.table.name')]),
        );
        return $messages;
    }
}
