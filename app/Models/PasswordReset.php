<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use HasFactory;

     /**
     * @var string
     */
    protected $table = 'password_resets';

    public $timestamps = true;

    protected $guarded = [];

    const TYPE_USER = 1;
    const TYPE_DOCTOR = 2;
    const COMPLETED_FALSE = 0;
    const COMPLETED_TRUE = 1;
}
