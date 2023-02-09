<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Shift extends Model
{
    use HasFactory, Notifiable;

    /**
     * @var string
     */
    protected $table = 'shifts';

    protected $guarded = [];

    public $timestamps = true;

    const PART = 0;
    const FULL = 1;
}
