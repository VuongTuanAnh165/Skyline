<?php

namespace App\Rules;

use App\Models\PasswordReset;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class CheckCodeForgotPasswordRule implements Rule
{
    public $userId;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
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
        $user = User::query()
            ->where('id' , $this->userId)
            // ->where('status', User::STATUS_ACTIVE)
            ->Active()
            ->first();
        if (!empty($user)){
            return true;
        }
        $data = PasswordReset::where('user_id', $this->userId)
            ->where('code',$value)
            ->where('expired_time' ,'>=', Carbon::now()->format('Y-m-d H:i:s'))
            ->where('completed' , PasswordReset::COMPLETED_FALSE)
            ->first();
        return !empty($data);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('messages.api.request.input_exists', ['attribute' => "Mã code"]);
    }
}
