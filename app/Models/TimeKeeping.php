<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TimeKeeping extends Model
{
    use HasFactory, Notifiable;

    /**
     * @var string
     */
    protected $table = 'time_keepings';

    protected $guarded = [];

    public $timestamps = true;
}
