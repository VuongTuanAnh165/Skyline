<?php

namespace App\Rules;

use App\Models\Restaurant;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class CheckEmailEditRestaurant implements Rule
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
        $oldEmail = Auth::guard('restaurant')->user()->email;
        $user = Restaurant::where('email', '<>', $oldEmail)->where('email' , $value)->first();
        return (!empty($user) || !isset($user));
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
