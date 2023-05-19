<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluates', function (Blueprint $table) {
            $table->id();
            $table->integer('web_type')->nullable(); //1: web_service, 2: web_user
            $table->integer('people_id')->nullable(); //column: id, table: user and ceo
            $table->integer('product_id')->nullable(); //column:id, table: restaurant and dish
            $table->longText('comment')->nullable();
            $table->integer('star')->nullable();
            $table->integer('status')->nullable(); //1: show, 0: hide
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
        Schema::dropIfExists('evaluates');
    }
}
