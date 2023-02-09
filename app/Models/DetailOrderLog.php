<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class DetailOrderLog extends Model
{
    use HasFactory, Notifiable;

    /**
     * @var string
     */
    protected $table = 'detail_order_logs';

    protected $guarded = [];

    public $timestamps = true;
}
