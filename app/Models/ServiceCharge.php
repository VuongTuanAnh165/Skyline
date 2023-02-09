<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ServiceCharge extends Model
{
    use HasFactory, Notifiable;

    /**
     * @var string
     */
    protected $table = 'service_charges';

    protected $guarded = [];

    public $timestamps = true;
}
