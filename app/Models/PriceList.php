<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PriceList extends Model
{
    use HasFactory, Notifiable;

    /**
     * @var string
     */
    protected $table = 'price_lists';

    protected $guarded = [];

    public $timestamps = true;

    const MODEL = [
        'Branch',
        'Category',
        'Dish',
        'Personnel',
        'Policy',
        'Position',
        'Post',
        'Promotion',
    ];
}
