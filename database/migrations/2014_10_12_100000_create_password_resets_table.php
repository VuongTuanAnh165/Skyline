<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasswordResetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('password_resets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('token');
            $table->integer('code');
            $table->dateTime('expired_time');
            $table->tinyInteger('completed')->default(0)->comment('0: Chưa hoàn thành, 1: đã hoàn thành');
            $table->dateTime('completed_at')->nullable();
            $table->tinyInteger('type')->default(1)->comment('1: User, 2: Doctor');
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
        Schema::dropIfExists('password_resets');
    }
}
