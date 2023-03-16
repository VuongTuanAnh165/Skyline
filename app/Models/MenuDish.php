<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class MenuDish extends Model
{
    use HasFactory, Notifiable;

    /**
     * @var string
     */
    protected $table = 'menu_dishes';

    protected $guarded = [];

    public $timestamps = true;
}
