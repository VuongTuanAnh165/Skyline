<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class DetailItemLog extends Model
{
    use HasFactory, Notifiable;

    /**
     * @var string
     */
    protected $table = 'detail_item_logs';

    protected $guarded = [];

    protected $casts = [
        'item' => 'array',
    ];

    public $timestamps = true;
}
