<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ServiceType extends Model
{
    use HasFactory, Notifiable;

    /**
     * @var string
     */
    protected $table = 'service_types';

    protected $guarded = [];

    protected $casts = [
        'price_list' => 'array',
    ];

    public $timestamps = true;

    const TYPE = [
        'Quản lý chi nhánh',
        'Quản lý chương trình khuyến mãi',
        'Quản lý nhân viên',
        'Quản lý món ăn',
        'Quản lý bài viết',
    ];
}
