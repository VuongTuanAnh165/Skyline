<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UserAddress extends Model
{
    use HasFactory, Notifiable;

    /**
     * @var string
     */
    protected $table = 'user_addresses';

    protected $guarded = [];

    public $timestamps = true;
}
