<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Promotion extends Model
{
    use HasFactory, Notifiable;

    /**
     * @var string
     */
    protected $table = 'promotions';

    protected $guarded = [];

    public $timestamps = true;

    const ADMINSERVICE = 1;
    const ADMINRESTAURANT = 2;
    const RESTAURANT = 3;
}
