<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderCeoLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_ceo_logs', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->integer('ceo_id');
            $table->integer('service_charge_id');
            $table->integer('type');
            $table->date('implementation_date');
            $table->longText('promotion_id')->nullable();
            $table->integer('status');
            $table->double('subtotal');
            $table->double('total');
            $table->string('vendor_order_id');
            $table->string('email');
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
        Schema::dropIfExists('order_ceo_logs');
    }
}
