<?php

namespace App\Http\Requests\AdminBe;

use Illuminate\Foundation\Http\FormRequest;

class AdminBeHelpRequest extends FormRequest
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
            'answer' => 'required',
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
            'answer.required' => trans('validation.form.input_required', ['attribute' => 'Câu trả lời']),
        );
        return $messages;
    }
}
