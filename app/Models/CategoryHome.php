<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CategoryHome extends Model
{
    use HasFactory, Notifiable;

    /**
     * @var string
     */
    protected $table = 'category_homes';

    protected $guarded = [];

    public $timestamps = true;
}
