<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColorTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('color_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('color_id')->constrained('colors')->cascadeOnDelete();
            $table->string('locale');
            $table->string('name');
            $table->unique(['color_id','locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('color_translations');
    }
}
