<?php

namespace App\Rules;

use App\Models\Activation;
use App\Models\PasswordReset;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class CheckCodeRegisterRule implements Rule
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
            ->where('id', $this->userId)
            ->where('status', User::STATUS_INACTIVE)
            ->first();
        if (!empty($user)) {
            return true;
        }
        $data = Activation::join('users', 'activations.user_id', 'users.id')
            ->where('activations.user_id', $this->userId)
            ->where('activations.code', $value)
            ->where('activations.expired_time', '>=', Carbon::now()->format('Y-m-d H:i:s'))
            ->where('activations.completed', PasswordReset::COMPLETED_FALSE)
            ->where('users.status', User::STATUS_INACTIVE)
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
