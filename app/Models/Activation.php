<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activation extends Model
{
    use HasFactory;

    const COMPLETEDTRUE = 1;
    /**
     * @var string
     */
    protected $table = 'activations';

    public $timestamps = true;

    protected $guarded = [];
}
