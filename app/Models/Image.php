<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Image extends Model
{
    use HasFactory, Notifiable;

    /**
     * @var string
     */
    protected $table = 'images';

    protected $guarded = [];

    public $timestamps = true;

    const WEBADMIN = 0;
    const WEBCUSTOMER = 1;
    const WEBRESTAURANT = 2;
    const WEBSELL = 3;
    const WEBSERVICE = 4;
    const WEBUSER = 5;
    const APPUSERSELL = 6;
    const APPSELL = 7;
}
