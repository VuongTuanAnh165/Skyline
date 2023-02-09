<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone', 12)->nullable();
            $table->date('birthday')->nullable();
            $table->string('address')->nullable();
            $table->string('avatar')->nullable();
            $table->string('facebook_id',30)->nullable();
            $table->string('google_id',30)->nullable();
            $table->string('zalo_id',30)->nullable();
            $table->tinyInteger('gender')->comment('1:male, 2:female');
            $table->string('password');
            $table->tinyInteger('status')->default(1)->comment('1:active, 2:inactive');
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
        Schema::dropIfExists('users');
    }
}
