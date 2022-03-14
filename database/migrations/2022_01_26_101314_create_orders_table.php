<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('address_id')->nullable()->constrained('addresses')->cascadeOnDelete();
            $table->foreignId('shipping_id')->nullable()->constrained('shippings')->cascadeOnDelete();
            $table->foreignId('promo_code_id')->nullable()->constrained('promo_codes')->cascadeOnDelete();
            $table->string('tax')->nullable();
            $table->string('shipping_price')->nullable();
            $table->string('promo_discount')->nullable();
            $table->double('price');
            $table->double('total_price')->nullable();
            $table->enum('status',['cart','pending','preparation','accepted','delivery','finish','refuse_by_user','refuse_by_vendor'])->default('cart');
            $table->enum('payment',['cash','online'])->default('cash');
            $table->string('payment_method')->nullable()->comment('like visa , sadad ,master card');
            $table->string('payment_id')->nullable();
            $table->text('notes')->nullable();
            $table->text('message')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
