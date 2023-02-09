<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Position extends Model
{
    use HasFactory, Notifiable;

    /**
     * @var string
     */
    protected $table = 'positions';

    protected $guarded = [];

    protected $casts = [
        'work_type' => 'array',
    ];

    public $timestamps = true;

    const PART = 0;
    const FULL = 1;
}
