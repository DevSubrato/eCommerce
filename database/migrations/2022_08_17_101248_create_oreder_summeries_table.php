<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oreder_summeries', function (Blueprint $table) {
            $table->id();
            $table->string('coupon_name')->nullable();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->integer('cart_total');
            $table->integer('discount_total')->default(0);
            $table->integer('shipping');
            $table->integer('sub_total');
            $table->integer('paymentable_total');
            $table->integer('payment_method');
            $table->integer('payment_status')->default(0);
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
        Schema::dropIfExists('oreder_summeries');
    }
};
