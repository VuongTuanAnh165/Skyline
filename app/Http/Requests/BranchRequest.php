<?php

namespace App\Http\Requests;

use App\Models\Branch;
use App\Rules\UniqueRule;
use Illuminate\Foundation\Http\FormRequest;

class BranchRequest extends FormRequest
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
        $input_unique = trans('validation.form.input_unique', ['attribute' => trans('messages.admin.branch.form.name')]);
        $rules = [
            'name' => ['required','regex:/^[0-9]*$/', new UniqueRule($this->route('id'), Branch::class, $this->name, $input_unique)],
            'address' => 'required',
            'open_time' => 'required',
            'close_time' => ['required', 'after:open_time'],
            'longitude' => 'required',
            'latitude' => 'required',
            'background' => 'nullable',
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
            'name.required' => trans('validation.form.input_required', ['attribute' => trans('messages.admin.branch.form.name')]),
            'name.regex' => trans('validation.form.ip_regex', ['attribute' => trans('messages.admin.branch.form.name')]),
            'address.required' => trans('validation.form.input_required', ['attribute' => trans('messages.admin.branch.table.address')]),
            'open_time.required' => trans('validation.form.input_required', ['attribute' => trans('messages.admin.branch.table.open_time')]),
            'close_time.required' => trans('validation.form.input_required', ['attribute' => trans('messages.admin.branch.table.close_time')]),
            'close_time.after' => trans('validation.open_close'),
            'longitude.required' => trans('validation.form.input_required', ['attribute' => trans('messages.admin.branch.form.longitude')]),
            'latitude.required' => trans('validation.form.input_required', ['attribute' => trans('messages.admin.branch.form.latitude')]),
        );
        return $messages;
    }
}
