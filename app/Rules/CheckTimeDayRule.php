<?php

namespace App\Rules;

use App\Models\Shift;
use Illuminate\Contracts\Validation\Rule;

class CheckTimeDayRule implements Rule
{
    private $name;
    private $start;
    private $work_type;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($name, $start, $work_type)
    {
        $this->name = $name;
        $this->start = $start;
        $this->work_type = $work_type;
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
        $shift = Shift::query()->where('work_type', $this->work_type)->where('name', $this->name - 1)->first();
        if(!$shift) {
            return true;
        } else {
            $check = Shift::query()->where('work_type', $this->work_type)->where('name', $this->name - 1)->whereTime('end', "<=", \Carbon\Carbon::parse($this->start))->first();
            if($check) {
                return true;
            }
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.start_end');
    }
}
