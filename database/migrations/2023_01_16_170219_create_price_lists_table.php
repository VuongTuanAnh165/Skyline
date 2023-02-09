<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_lists', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('id_request')->nullable();
            $table->string('value_request')->nullable();
            $table->integer('service_id')->nullable();
            $table->integer('type_service')->nullable();// 1: quản lý restaurant/shop, 2: quản lý bán hàng
            $table->integer('type_list')->nullable();// 1: cho phép chọn nhập điều kiệu, 2: true/false
            $table->integer('model')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('price_lists');
    }
}
