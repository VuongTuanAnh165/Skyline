<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Evaluate extends Model
{
    use HasFactory, Notifiable;

    /**
     * @var string
     */
    protected $table = 'evaluates';

    protected $guarded = [];

    public $timestamps = true;
}
