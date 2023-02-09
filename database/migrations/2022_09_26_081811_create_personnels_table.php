<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonnelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personnels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('avatar')->nullable();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('phone');
            $table->date('birthday')->nullable();
            $table->tinyInteger('gender')->nullable()->comment('1:male, 2:female');
            $table->integer('bank_id')->nullable();
            $table->string('account_number')->nullable();
            $table->integer('position_id');
            $table->integer('work_type')->nullable();
            $table->integer('shift_id')->nullable()->comment('1:sáng, 2:chiều');
            $table->integer('province_id')->nullable();
            $table->integer('district_id')->nullable();
            $table->integer('commune_id')->nullable();
            $table->string('address')->nullable();
            $table->rememberToken();
            $table->tinyInteger('status')->default(1)->comment('0: Pending, 1: Active');
            $table->date('started_at')->nullable();
            $table->date('signed_at')->nullable();
            $table->date('ended_at')->nullable();
            $table->integer('restaurant_id');
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
        Schema::dropIfExists('personnels');
    }
}
