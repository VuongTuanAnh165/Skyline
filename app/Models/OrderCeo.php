<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class OrderCeo extends Model
{
    use HasFactory, Notifiable;

    /**
     * @var string
     */
    protected $table = 'order_ceos';

    protected $guarded = [];

    protected $casts = [
        'promotion_id' => 'array',
    ];

    public $timestamps = true;

    const PENDING = 0;
    const COMPLETED = 1;
}
