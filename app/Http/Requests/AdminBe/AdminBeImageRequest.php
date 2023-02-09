<?php

namespace App\Http\Requests\AdminBe;

use Illuminate\Foundation\Http\FormRequest;

class AdminBeImageRequest extends FormRequest
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
            'type' => 'required',
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
            'type.required' => trans('validation.form.input_required', ['attribute' => trans('messages.admin.image.table.type')]),
        );
        return $messages;
    }
}
