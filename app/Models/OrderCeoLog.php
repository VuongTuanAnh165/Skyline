<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class OrderCeoLog extends Model
{
    use HasFactory, Notifiable;

    /**
     * @var string
     */
    protected $table = 'order_ceo_logs';

    protected $guarded = [];

    protected $casts = [
        'promotion_id' => 'array',
    ];

    public $timestamps = true;
}
