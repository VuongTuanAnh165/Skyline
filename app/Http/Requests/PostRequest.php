<?php

namespace App\Http\Requests;

use App\Models\Post;
use App\Rules\UniqueRule;
use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        $input_unique = trans('validation.form.input_unique', ['attribute' => trans('messages.admin.post.table.name')]);
        $rules = [
            'name' => ['required', new UniqueRule($this->route('id'), Post::class, $this->name, $input_unique)],
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
            'name.required' => trans('validation.form.input_required', ['attribute' => trans('messages.admin.post.table.name')]),
        );
        return $messages;
    }
}
