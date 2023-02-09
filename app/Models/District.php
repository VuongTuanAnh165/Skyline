<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class District extends Model
{
    use HasFactory, Notifiable;

    /**
     * @var string
     */
    protected $table = 'districts';

    protected $guarded = [];

    public $timestamps = true;
}
