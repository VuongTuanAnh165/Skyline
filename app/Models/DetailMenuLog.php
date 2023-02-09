<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class DetailMenuLog extends Model
{
    use HasFactory, Notifiable;

    /**
     * @var string
     */
    protected $table = 'detail_menu_logs';

    protected $guarded = [];

    public $timestamps = true;
}
