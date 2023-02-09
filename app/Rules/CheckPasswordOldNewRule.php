<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckPasswordOldNewRule implements Rule
{
    private $old;
    private $new;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($old, $new)
    {
        $this->old = $old;
        $this->new = $new;
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
        if($this->old === $this->new) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.password_old_new');
    }
}
