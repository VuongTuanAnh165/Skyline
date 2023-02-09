<?php

namespace App\Http\Requests\AdminBe;

use Illuminate\Foundation\Http\FormRequest;

class AdminBeCategoryHomeRequest extends FormRequest
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
            'name' => ['required', 'unique:category_homes,name,' . $this->route('id')]
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
            'name.required' => trans('validation.form.input_required', ['attribute' => trans('messages.admin.category.table.name')]),
            'name.unique' => trans('validation.form.input_unique', ['attribute' => trans('messages.admin.category.table.name')]),
        );
        return $messages;
    }
}
