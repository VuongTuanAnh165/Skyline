<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('category_id');
            $table->double('price');
            $table->longText('image')->nullable();
            $table->string('name_link')->nullable();
            $table->longText('content')->nullable();
            $table->longText('category_home_id')->nullable();
            $table->integer('restaurant_id');
            $table->longText('branch_id');
            $table->integer('create_by')->nullable();
            $table->integer('update_by')->nullable();
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
        Schema::dropIfExists('dishes');
    }
}
