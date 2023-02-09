<?php

namespace App\Rules;

use App\Models\Personnel;
use App\Models\Position;
use Illuminate\Contracts\Validation\Rule;

class CheckPersonnelPosition implements Rule
{
    private $id;
    private $position_id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($id, $position_id)
    {
        $this->id = $id;
        $this->position_id = $position_id;
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
        $position = Position::find($this->position_id);
        $personnels = Personnel::where('position_id', $this->position_id)->get();
        $personnel = Personnel::find($this->id);
        if(!$this->id) {
            if(count($personnels) >= $position->amount_personnel) {
                return false;
            }
            return true;
        }
        if($personnel->position_id != $this->position_id) {
            if(count($personnels) >= $position->amount_personnel) {
                return false;
            }
            return true;
        } else {
            if(count($personnels) > $position->amount_personnel) {
                return false;
            }
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.personnel_position');
    }
}
