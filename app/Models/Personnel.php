<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Personnel extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * @var string
     */
    protected $table = 'personnels';

    protected $guarded = [];

    public $timestamps = true;
    const GENDER = [
        'boy' => 0,
        'girl' => 1,
    ];

    const SHIFTS = [
        'morning' => 0,
        'afternoon' => 1,
    ];
}
