<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderUserLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_user_logs', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->longText('table_id')->nullable();
            $table->double('total_money')->nullable();
            $table->double('payment')->nullable();
            $table->integer('branch_id')->nullable();
            $table->integer('create_by')->nullable();
            $table->integer('update_by')->nullable();
            $table->integer('status_payment')->nullable();
            $table->longText('status')->nullable();
            $table->string('vendor_order_id')->nullable();
            $table->integer('type')->nullable();
            $table->longText('promotion_id')->nullable();
            $table->dateTime('implementation_date')->nullable();
            $table->integer('personnel_ship')->nullable();
            $table->longText('detail')->nullable();
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
        Schema::dropIfExists('order_user_logs');
    }
}
