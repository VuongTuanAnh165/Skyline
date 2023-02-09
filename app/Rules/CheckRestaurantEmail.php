<?php

namespace App\Rules;

use App\Models\Personnel;
use App\Models\Restaurant;
use Illuminate\Contracts\Validation\Rule;

class CheckRestaurantEmail implements Rule
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
        $restaurant = Restaurant::where('email' , $value)->first();
        $personnel = Personnel::where('email' , $value)->first();
        return !(empty($restaurant) && empty($personnel));
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
