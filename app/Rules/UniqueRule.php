<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\returnSelf;

class UniqueRule implements Rule
{
    private $id;
    private $model;
    private $name;
    private $input_unique;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($id, $model, $name, $input_unique)
    {
        $this->id = $id;
        $this->model = $model;
        $this->name = $name;
        $this->input_unique = $input_unique;
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
        // if (empty($this->id)) {
        //     $data = $this->model::query()
        //         ->where('restaurant_id', Auth::guard('restaurant')->user()->id)
        //         ->where('name', $this->name)
        //         ->first();
        //     if ($data) {
        //         return false;
        //     }
        //     return true;
        // } else {
        //     $data = $this->model::query()
        //         ->where('restaurant_id', Auth::guard('restaurant')->user()->id)
        //         ->where('id', '<>', $this->id)
        //         ->where('name', $this->name)
        //         ->first();
        //     if ($data) {
        //         return false;
        //     }
        //     return true;
        // }

        $data = $this->model::query()
            ->where('restaurant_id', Auth::guard('restaurant')->user()->id)
            ->where('name', $this->name);
        if (!empty($this->id)) {
            $data = $data->where('id', '<>', $this->id);
        }
        $data = $data->first();
        if ($data) {
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
        return $this->input_unique;
    }
}
