<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Ceo extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * @var string
     */
    protected $table = 'ceos';

    protected $guarded = [];

    public $timestamps = true;
}
