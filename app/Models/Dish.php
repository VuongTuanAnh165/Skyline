<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Dish extends Model
{
    use HasFactory, Notifiable;

    /**
     * @var string
     */
    protected $table = 'dishes';

    protected $guarded = [];

    protected $casts = [
        'category_home_id' => 'array',
        'branch_id' => 'array',
    ];

    public $timestamps = true;

    const MESS_RESTAURANT = [
        'dish' => [
            'title' => 'Món ăn',
            'table' => [
                'title' => 'Bảng danh sách món ăn',
                'name' => 'Tên món',
                'image' => 'Hình ảnh',
                'category' => 'Loại món',
                'price' => 'Giá',
                'ingredient' => 'Menu món',
                'category_home' => 'Nhóm trang chủ'
            ],
            'create' => [
                'title' => 'Thêm mới món ăn',
            ],
            'edit' => [
                'title' => 'Chỉnh sửa món ăn',
            ],
        ],
        'category' => [
            'title' => 'Danh mục món',
            'table' => [
                'title' => 'Bảng danh sách danh mục món',
                'name' => 'Tên danh mục',
            ],
            'create' => [
                'title' => 'Thêm mới danh mục',
            ],
            'edit' => [
                'title' => 'Chỉnh sửa danh mục',
            ],
        ],
        'menu' => [
            'title' => 'Menu món',
            'table' => [
                'title' => 'Bảng danh sách menu món',
            ],
        ]
    ];

    const MESS_SHOP = [
        'dish' => [
            'title' => 'Sản phẩm',
            'table' => [
                'title' => 'Bảng danh sách sản phẩm',
                'name' => 'Tên sản phẩm',
                'image' => 'Hình ảnh',
                'category' => 'Loại sản phẩm',
                'price' => 'Giá',
                'category_home' => 'Nhóm trang chủ'
            ],
            'create' => [
                'title' => 'Thêm mới sản phẩm',
            ],
            'edit' => [
                'title' => 'Chỉnh sửa sản phẩm',
            ],
        ],
        'category' => [
            'title' => 'Danh mục sản phẩm',
            'table' => [
                'title' => 'Bảng danh sách danh mục sản phẩm',
                'name' => 'Tên danh mục',
            ],
            'create' => [
                'title' => 'Thêm mới danh mục',
            ],
            'edit' => [
                'title' => 'Chỉnh sửa danh mục',
            ],
        ],
        'menu' => [
            'title' => 'Menu sản phẩm',
            'table' => [
                'title' => 'Bảng danh sách menu sản phẩm',
            ],
        ]
    ];
}
