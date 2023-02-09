<?php

namespace App\Rules;

use App\Models\Admin;
use Illuminate\Contracts\Validation\Rule;

class CheckAdminBeEmail implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $ceo = Admin::where('email' , $value)->first();
        return !empty($ceo);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('messages.api.request.input_exists', ['attribute' => "Email"]);
    }
}
