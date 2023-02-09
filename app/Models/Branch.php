<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Branch extends Model
{
    use HasFactory, Notifiable;

    /**
     * @var string
     */
    protected $table = 'branches';

    protected $guarded = [];

    public $timestamps = true;

    protected $casts = [
        'background' => 'array',
    ];
}
