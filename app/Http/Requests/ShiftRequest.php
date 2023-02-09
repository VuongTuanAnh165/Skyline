<?php

namespace App\Http\Requests;

use App\Rules\CheckTimeDayRule;
use App\Rules\checkTimeEndRull;
use App\Rules\CloseTimeRule;
use Illuminate\Foundation\Http\FormRequest;

class ShiftRequest extends FormRequest
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
            'start' => ['required', new CheckTimeDayRule($this->name, $this->start, $this->work_type)],
            'end' => ['required', 'after:start', new checkTimeEndRull($this->name, $this->end, $this->work_type)],
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
            'start.required' => trans('validation.form.input_required', ['attribute' => trans('messages.admin.shift.form.start')]),
            'end.required' => trans('validation.form.input_required', ['attribute' => trans('messages.admin.shift.form.end')]),
            'end.after' => trans('validation.open_close'),
        );
        return $messages;
    }
}
