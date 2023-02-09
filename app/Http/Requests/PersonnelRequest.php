<?php

namespace App\Http\Requests;

use App\Rules\CheckPersonnelPosition;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class PersonnelRequest extends FormRequest
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
        $today = Carbon::now()->subYears(18)->format('Y-m-d');
        $rules = [
            'name' => 'required',
            'avatar' => 'nullable',
            'email' => 'required|email|unique:personnels,email,' . $this->route('id'),
            'phone' => 'required|min:10|max:11|regex:/^[0-9]*$/|unique:personnels,phone,' . $this->route('id'),
            'birthday' => 'required|before:'.$today,
            'gender' => 'nullable',
            'bank_id' => 'nullable',
            'account_number' => 'nullable|regex:/^[0-9]*$/',
            'position_id' => ['required', new CheckPersonnelPosition($this->route('id'), $this->position_id)],
            'province_id' => 'nullable',
            'district_id' => 'nullable',
            'commune_id' => 'nullable',
            'address' => 'nullable',
            'ended_at' => 'nullable',
            'started_at' => 'nullable|before:ended_at',
            'signed_at' => 'nullable|before:ended_at',
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
            'name.required' => trans('validation.form.input_required', ['attribute' => trans('messages.admin.personnel.table.name')]),
            'email.required' => trans('validation.form.input_required', ['attribute' => trans('messages.admin.personnel.table.email')]),
            'email.email' => trans('validation.form.ip_regex', ['attribute' => trans('messages.admin.personnel.table.email')]),
            'email.unique' => trans('validation.form.input_unique', ['attribute' => trans('messages.admin.personnel.table.email')]),
            'password.min' => trans('validation.form.input_min', ['attribute' => trans('messages.admin.personnel.form.password'), 'min' => "6"]),
            'phone.required' => trans('validation.form.input_required', ['attribute' => trans('messages.admin.personnel.table.phone')]),
            'phone.min' => trans('validation.form.ip_regex', ['attribute' => trans('messages.admin.personnel.table.phone')]),
            'phone.max' => trans('validation.form.ip_regex', ['attribute' => trans('messages.admin.personnel.table.phone')]),
            'phone.regex' => trans('validation.form.ip_regex', ['attribute' => trans('messages.admin.personnel.table.phone')]),
            'phone.unique' => trans('validation.form.input_unique', ['attribute' => trans('messages.admin.personnel.table.phone')]),
            'birthday.required' => trans('validation.form.input_required', ['attribute' => trans('messages.admin.personnel.form.birthday')]),
            'birthday.before' => trans('validation.form.input_before_personnel', ['attribute' => trans('messages.admin.personnel.title')]),
            'position_id.required' => trans('validation.form.input_required', ['attribute' => trans('messages.admin.personnel.table.position')]),
            'account_number.regex' => trans('validation.form.ip_regex', ['attribute' => trans('messages.admin.personnel.form.account_number')]),
            'started_at.before' => trans('validation.form.end_before', ['attribute' => trans('messages.admin.personnel.form.started_at'), 'date' => trans('messages.admin.personnel.form.ended_at')]),
            'signed_at.before' => trans('validation.form.end_before', ['attribute' => trans('messages.admin.personnel.form.signed_at'), 'date' => trans('messages.admin.personnel.form.ended_at')]),
        );
        return $messages;
    }
}
