<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Help extends Model
{
    use HasFactory, Notifiable;

    /**
     * @var string
     */
    protected $table = 'helps';

    protected $guarded = [];

    public $timestamps = true;
}
