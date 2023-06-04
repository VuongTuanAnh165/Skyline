<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PayPalLog extends Model
{
    use HasFactory, Notifiable;

    /**
     * @var string
     */
    protected $table = 'pay_pal_logs';

    protected $guarded = [];

    protected $casts = [
        'data' => 'array',
    ];

    public $timestamps = true;
}
