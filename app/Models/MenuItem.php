<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class MenuItem extends Model
{
    use HasFactory, Notifiable;

    /**
     * @var string
     */
    protected $table = 'menu_items';

    protected $guarded = [];

    public $timestamps = true;
}
