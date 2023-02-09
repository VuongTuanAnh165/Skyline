<?php

namespace App\Http\Requests\Ceo;

use Illuminate\Foundation\Http\FormRequest;

class CeoHelpRequest extends FormRequest
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
            'service_id' => 'required',
            'question' => 'required',
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
            'service_id.required' => trans('validation.form.input_required', ['attribute' => 'Dịch vụ']),
            'question.required' => trans('validation.form.input_required', ['attribute' => 'Câu hỏi']),
        );
        return $messages;
    }
}
