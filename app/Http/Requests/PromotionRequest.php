<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class PromotionRequest extends FormRequest
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
            'name' => ['required'],
            'type' => 'required',
            'condition' => 'required',
            'value' => 'required',
            'started_at' => 'required|before:ended_at',
            'ended_at' => 'required',
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
            'name.required' => trans('validation.form.input_required', ['attribute' => trans('messages.admin.promotion.table.name')]),
            'type.required' => trans('validation.form.input_required', ['attribute' => trans('messages.admin.promotion.table.type')]),
            'condition.required' => trans('validation.form.input_required', ['attribute' => trans('messages.admin.promotion.table.condition')]),
            'value.required' => trans('validation.form.input_required', ['attribute' => trans('messages.admin.promotion.table.value')]),
            'started_at.required' => trans('validation.form.input_required', ['attribute' => trans('messages.admin.promotion.table.started_at')]),
            'started_at.before' => trans('validation.form.end_before', ['attribute' => trans('messages.admin.personnel.form.started_at'), 'date' => trans('messages.admin.promotion.table.ended_at')]),
            'ended_at.required' => trans('validation.form.input_required', ['attribute' => trans('messages.admin.promotion.table.ended_at')]),
        );
        return $messages;
    }
}
