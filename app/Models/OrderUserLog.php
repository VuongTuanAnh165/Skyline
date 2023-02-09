<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class OrderUserLog extends Model
{
    use HasFactory, Notifiable;

    /**
     * @var string
     */
    protected $table = 'order_user_logs';

    protected $guarded = [];

    protected $casts = [
        'promotion_id' => 'array',
        'table_id' => 'array',
        'detail' => 'array',
        'status' => 'array',
    ];

    public $timestamps = true;
}
