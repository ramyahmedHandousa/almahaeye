<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shipping_id')->constrained('shippings')->cascadeOnDelete();
            $table->string('locale');
            $table->string('name');
            $table->unique(['shipping_id','locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipping_translations');
    }
}
